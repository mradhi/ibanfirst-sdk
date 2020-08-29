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

namespace IBanFirst\Integration;

use IBanFirst\IBanFirst;
use IBanFirst\IBanFirstEnvironment;
use IBanFirst\TestDataTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

abstract class IntegrationTest extends TestCase
{
    use TestDataTrait;

    public function createSDKAndMock(string $responseBody): IBanFirst
    {
        return new IBanFirst([
            'environment' => IBanFirstEnvironment::SANDBOX,
            'username' => 'foo',
            'password' => 'bar',
            'http_client' => new MockHttpClient(
                new MockResponse($responseBody)
            )
        ]);
    }
}