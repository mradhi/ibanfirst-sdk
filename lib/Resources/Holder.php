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
 * @property-read         $name
 * @property-read         $type
 * @property-read Address $address
 */
class Holder extends AbstractResource
{
    protected array $map = [
        'address' => Address::class
    ];

    /**
     * The name of the account owner.
     *
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * The code identifying the type of account owner.
     * Can be {Individual} or {Corporate}.
     *
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * The account owner address.
     *
     * @var Address
     */
    protected Address $address;
}