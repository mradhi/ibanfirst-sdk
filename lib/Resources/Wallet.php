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
 * @property-read        $id
 * @property-read        $tag
 * @property-read        $currency
 * @property-read Amount $bookingAmount
 * @property-read Amount $valueAmount
 * @property-read        $dateLastFinancialMovement
 */
class Wallet extends AbstractResource
{
    protected array $map = [
        'bookingAmount' => Amount::class,
        'valueAmount' => Amount::class
    ];

    /**
     * The code identifying the wallet.
     *
     * @var string
     */
    protected string $id;

    /**
     * The custom wording of the wallet.
     *
     * @var string|null
     */
    protected ?string $tag = null;

    /**
     * The three-digit code identifying the currency of the wallet.
     *
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * The total amount booked on the account.
     *
     * @var Amount
     */
    protected Amount $bookingAmount;

    /**
     * The total amount available in the wallet.
     *
     * @var Amount
     */
    protected Amount $valueAmount;

    /**
     * The date of the last financial move in this wallet.
     *
     * @var string|null
     */
    protected ?string $dateLastFinancialMovement = null;
}
