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

namespace IBanFirst\Authenticator;

use IBanFirst\Exception\AuthenticatorException;
use IBanFirst\Request\Request;
use IBanFirst\Request\RequestInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

class UsernameTokenAuthenticatorTest extends TestCase
{
    public function testNoUsernameOptionFails(): void
    {
        $this->expectException(AuthenticatorException::class);
        $this->expectExceptionMessage('Missing required option "username".');

        new UsernameTokenAuthenticator([]);
    }

    public function testNotStringUsernameOptionFails(): void
    {
        $this->expectException(AuthenticatorException::class);
        $this->expectExceptionMessage('Option "username" can only be a string, "object" given.');

        new UsernameTokenAuthenticator(['username' => new stdClass()]);
    }

    public function testNoPasswordOptionFails(): void
    {
        $this->expectException(AuthenticatorException::class);
        $this->expectExceptionMessage('Missing required option "password".');

        new UsernameTokenAuthenticator(['username' => 'foo']);
    }

    public function testNotStringPasswordOptionFails(): void
    {
        $this->expectException(AuthenticatorException::class);
        $this->expectExceptionMessage('Option "password" can only be a string, "object" given.');

        new UsernameTokenAuthenticator(['username' => 'foo', 'password' => new stdClass()]);
    }

    public function testCreatesAuthenticatorSuccessfully(): void
    {
        $authenticator = new UsernameTokenAuthenticator(['username' => 'foo', 'password' => 'bar']);

        $this->assertNotNull($authenticator);
        $this->assertInstanceOf(RequestInterface::class, $authenticator->authenticate(new Request('uri', 'bar')));
    }
}