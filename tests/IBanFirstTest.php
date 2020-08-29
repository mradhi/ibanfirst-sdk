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

use IBanFirst\Exception\SDKException;
use IBanFirst\Service\WalletsService;
use PHPUnit\Framework\TestCase;

class IBanFirstTest extends TestCase
{
    public function testNoEnvironmentOptionFails(): void
    {
        $this->expectException(SDKException::class);
        $this->expectExceptionMessage('Missing required option "environment"');

        new IBanFirst();
    }

    public function testInvalidAuthenticatorOptionFails(): void
    {
        $this->expectException(SDKException::class);
        $this->expectExceptionMessage('The provided authenticator "foo" is not supported.');

        new IBanFirst(['environment' => 'sandbox', 'authenticator' => 'foo']);
    }

    public function testCreatesIBanFirstSuccessfully(): void
    {
        $iBanFirst = new IBanFirst(['environment' => 'sandbox', 'username' => 'foo', 'password' => 'bar']);

        $this->assertNotNull($iBanFirst);
        $this->assertInstanceOf(WalletsService::class, $iBanFirst->wallets());
    }
}