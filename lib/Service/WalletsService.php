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
use IBanFirst\Resources\Wallet;
use IBanFirst\Resources\WalletDetails;
use IBanFirst\Response\ListResponse;

class WalletsService extends AbstractService
{
    /**
     * With the Retrieve wallet list service, you can list obtain the list of all wallet account hold with IBanFirst.
     * The object return in the Array is a simplified version of the Wallet providing you the main information on the
     * wallet without any additional request.
     *
     * @param array $params
     *
     * @return AbstractResource|ListResponse
     *
     * @throws ResponseException
     */
    public function getList(array $params = []): ListResponse
    {
        $response = $this->client->send(
            new Request('/wallets/', 'GET', $params)
        );

        return $this->getListFromResponse($response, Wallet::class, 'wallets');
    }

    /**
     * This request allows you to see the details related to a specific wallet.
     *
     * @param string $id
     * @param array  $params
     *
     * @return AbstractResource|WalletDetails
     *
     * @throws ResponseException
     */
    public function getDetails(string $id, array $params = []): WalletDetails
    {
        $response = $this->client->send(
            new Request('/wallets/-' . $id, 'GET', $params)
        );

        return $this->getResourceFromResponse($response, WalletDetails::class, 'wallet');
    }
}