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

namespace IBanFirst\Service;

use IBanFirst\IBanFirstHttpClient;
use IBanFirst\Resources\AbstractResource;
use IBanFirst\Response\ListResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractService
{
    /**
     * Internal API client for making API requests.
     *
     * @var IBanFirstHttpClient
     */
    protected IBanFirstHttpClient $client;

    /**
     * Constructor for all base services, passes in the internal http client.
     *
     * @param IBanFirstHttpClient $client
     */
    public function __construct(IBanFirstHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Takes a raw response and returns either an instantiated resource or a
     * ListResponse.
     *
     * @param ResponseInterface $response
     * @param string            $resourceClass class to instantiate for each returned resource.
     * @param string|null       $envelopKey the key to envelope and unenvelope API requests/responses.
     *
     * @return AbstractResource
     */
    public function getResourceFromResponse(ResponseInterface $response, string $resourceClass, string $envelopKey = null)
    {
        $data = $response->toArray();

        if (null !== $envelopKey && array_key_exists($envelopKey, $data)) {
            $data = $data[$envelopKey];
        }

        return new $resourceClass($data);
    }

    /**
     * @param ResponseInterface $response
     * @param string            $resourceClass
     * @param string|null       $envelopKey
     *
     * @return ListResponse
     */
    public function getListFromResponse(ResponseInterface $response, string $resourceClass, string $envelopKey = null): ListResponse
    {
        $data = $response->toArray();

        if (null !== $envelopKey && array_key_exists($envelopKey, $data)) {
            $data = $data[$envelopKey];
        }

        return new ListResponse($data, $resourceClass, $response);
    }
}