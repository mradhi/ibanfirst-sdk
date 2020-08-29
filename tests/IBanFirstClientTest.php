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

use Exception;
use IBanFirst\Exception\ResponseException;
use PHPUnit\Framework\TestCase;

class IBanFirstClientTest extends TestCase
{
    use TestConfigTrait;

    /**
     * @group client
     */
    public function testItConnectToClientFails(): void
    {
        // This is a real test to call the iBanFirst API endpoint.
        $iBanFirst = new IBanFirst(['environment' => IBanFirstEnvironment::SANDBOX, 'username' => 'foo', 'password' => 'bar']);

        try {
            $iBanFirst->wallets()->getList();
        } catch (ResponseException $exception) {
            // Unauthorized to access to the resource.
            $this->assertEquals(403, $exception->getStatusCode());
        }

        $iBanFirst = new IBanFirst(
            $this->getConfig('client')
        );

        try {
            $response = $iBanFirst->wallets()->getList()
                ->getResponse();
        } catch (Exception $e) {
            $this->fail('Failed to communicate with iBanFirst API properly.');
            return;
        }

        $this->assertEquals(200, $response->getStatusCode());
    }
}