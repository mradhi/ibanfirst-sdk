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
 * @property-read        $bookingDate
 * @property-read        $walletId
 * @property-read        $valueDate
 * @property-read Amount $amount
 */
class FinancialMovements extends AbstractResource
{
    protected array $map = [
        'amount' => Amount::class
    ];

    /**
     * The ID referring the financial movement.
     *
     * @var string
     */
    protected string $id;

    /**
     * The booking Datetime of the financial movement.
     *
     * @var string|null
     */
    protected ?string $bookingDate = null;

    /**
     * The wallet ID on which the financial movement is.
     *
     * @var string|null
     */
    protected ?string $walletId = null;

    /**
     * The value Datetime of the financial movement.
     *
     * @var string|null
     */
    protected ?string $valueDate = null;

    /**
     * An array representing the amount concerned by the financial movement.
     *
     * @var Amount
     */
    protected Amount $amount;
}