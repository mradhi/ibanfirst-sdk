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

use IBanFirst\Authenticator\AuthenticatorInterface;

interface RequestInterface
{
    /**
     * Get the request URI.
     *
     * @return string
     */
    public function getURI(): string;

    /**
     * Get the request method (GET, POST, PUT, PATCH and DELETE).
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Get the request headers.
     *
     * @return array
     */
    public function getOptions(): array;

    /**
     * This method used to modify request headers.
     *
     * @param array $headers
     *
     * @see AuthenticatorInterface
     *
     */
    public function replaceHeaders(array $headers): void;
}