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

namespace IBanFirst\Resources;

/**
 * @property-read $value
 * @property-read $currency
 */
class Amount extends AbstractResource
{
    /**
     * The quantity of the currency.
     *
     * @var string|null
     */
    protected ?string $value = null;

    /**
     * The three-digit code specifying the currency related to the amount.
     *
     * @var string|null
     */
    protected ?string $currency = null;
}