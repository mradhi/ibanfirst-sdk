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

namespace IBanFirst\Response;

use IBanFirst\Resources\AbstractResource;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListResponse
{
    protected array $records = [];

    protected ResponseInterface $response;

    protected array $data;

    /**
     * Creates a new list response of the same resource class and decodes
     * the array from the raw response.
     *
     * @param array             $unenvelopedBody
     * @param string            $resourceClass
     * @param ResponseInterface $response
     */
    public function __construct(array $unenvelopedBody, string $resourceClass, ResponseInterface $response)
    {
        $this->response = $response;

        foreach ($unenvelopedBody as $item) {
            $this->records[] = new $resourceClass($item);
        }

        $this->data = $unenvelopedBody;
    }

    /**
     * @return AbstractResource[]
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Key value array data representation of the list.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
