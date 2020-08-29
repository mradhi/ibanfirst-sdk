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

namespace IBanFirst\Request;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testValidRequestObject(): void
    {
        $this->assertInstanceOf(RequestInterface::class, new Request('foo', 'bar'));
    }

    public function testAppendHeaderIfNotFound(): void
    {
        $request = new Request('foo', 'bar');

        $request->replaceHeaders(['header-1' => 'val']);

        $this->assertArrayHasKey('header-1', $request->getOptions()['headers']);

        $request->replaceHeaders(['header-2' => 'val']);

        $this->assertCount(2, $request->getOptions()['headers']);

        $this->assertArrayHasKey('header-2', $request->getOptions()['headers']);
    }
}