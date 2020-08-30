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

use IBanFirst\Exception\ResponseException;
use IBanFirst\Request\Request;
use IBanFirst\Resources\AbstractResource;
use IBanFirst\Resources\FinancialMovements;
use IBanFirst\Resources\FinancialMovementsDetails;
use IBanFirst\Response\ListResponse;

class FinancialMovementsService extends AbstractService
{
    /**
     * Request the list of financial movements that has been received or sent on a specific period of time.
     *
     * @param array $params
     *
     * @return ListResponse
     *
     * @throws ResponseException
     */
    public function getList(array $params = []): ListResponse
    {
        $response = $this->client->send(
            new Request('/financialMovements/', 'GET', $params)
        );

        return $this->getListFromResponse($response, FinancialMovements::class, 'financialMovements');
    }

    /**
     * This request allows you to see the details related to a specific wallet.
     *
     * @param string $id
     * @param array  $params
     *
     * @return AbstractResource|FinancialMovementsDetails
     *
     * @throws ResponseException
     */
    public function getDetails(string $id, array $params = [])
    {
        $response = $this->client->send(
            new Request('/financialMovements/-' . $id, 'GET', $params)
        );

        return $this->getResourceFromResponse($response, FinancialMovementsDetails::class, 'financialMovement');
    }
}
