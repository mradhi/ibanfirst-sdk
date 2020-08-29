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

use IBanFirst\Exception\ResponseException;
use IBanFirst\Request\Request;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class IBanFirstHttpClientTest extends TestCase
{
    use TestDataTrait;

    public function testSuccessfulResponse(): void
    {
        $data = ['foo' => ['bar' => 'baz']];
        $body = json_encode($data);

        $baseClient = new MockHttpClient(
            new MockResponse($body, ['http_code' => 200])
        );

        $iBanFirstHttpClient = new IBanFirstHttpClient('http://example.com', $baseClient);
        $response = $iBanFirstHttpClient->send(new Request('/uri', 'GET'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($body, $response->getContent());
    }

    public function testErrorResponse(): void
    {
        $body = $this->loadFixture('response_error');

        $baseClient = new MockHttpClient(
            new MockResponse($body, ['http_code' => 401])
        );

        $this->expectException(ResponseException::class);

        $iBanFirstHttpClient = new IBanFirstHttpClient('http://example.com', $baseClient);

        try {
            $iBanFirstHttpClient->send(new Request('/uri', 'GET'));
        } catch (ResponseException $e) {
            $this->assertEquals(401, $e->getStatusCode());
            $this->assertEquals('Unauthorized', $e->getErrorType());
            $this->assertEquals(15, $e->getErrorCode());
            $this->assertEquals('You must use the WSSE secured authentication to access this resource.', $e->getErrorMessage());
            throw $e;
        }
    }
}