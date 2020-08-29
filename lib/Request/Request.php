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

class Request implements RequestInterface
{
    protected string $uri;

    protected string $method;

    protected array $options;

    public function __construct(string $uri, string $method, array $options = [])
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->options = $options;
    }


    /**
     * @inheritDoc
     */
    public function getURI(): string
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function replaceHeaders(array $headers): void
    {
        $this->options = array_merge_recursive($this->options, ['headers' => $headers]);
    }
}