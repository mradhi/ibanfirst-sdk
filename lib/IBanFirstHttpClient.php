<?php
/*
 * This file is part of the iBanFirst HTTP Client package.
 *
 * (c) Radhi GUENNICHI <guennichiradhi@gmail.com> <+216 50 711 816>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace IBanFirst;

use IBanFirst\Authenticator\AuthenticatorInterface;
use IBanFirst\Exception\ResponseException;
use IBanFirst\Request\RequestInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface as BaseHttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class IBanFirstHttpClient
{
    protected BaseHttpClientInterface $baseHttpClient;

    protected ?AuthenticatorInterface $authenticator = null;

    protected string $baseURL;

    public function __construct(string $baseURL, BaseHttpClientInterface $baseHttpClient, AuthenticatorInterface $authenticator = null)
    {
        $this->baseURL = $baseURL;
        $this->authenticator = $authenticator;
        $this->baseHttpClient = $baseHttpClient;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws ResponseException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        if (null !== $this->authenticator) {
            $this->authenticator->authenticate($request);
        }

        $response = $this->baseHttpClient->request($request->getMethod(), $this->baseURL . $request->getURI(), $request->getOptions());

        $this->handleErrors($response);

        return $response;
    }

    public function handleErrors(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode < 400) {
            return;
        }

        throw new ResponseException(
            json_decode($response->getContent(false)),
            $statusCode
        );
    }
}