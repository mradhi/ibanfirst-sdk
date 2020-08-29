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
 * @property-read         $bic
 * @property-read         $name
 * @property-read Address $address
 */
class CorrespondentBank extends AbstractResource
{
    protected array $map = [
        'address' => Address::class
    ];

    /**
     * Eight or eleven-digit ISO 9362 Business Identifier Code specifying the Recipient Bank.
     *
     * @var string|null
     */
    protected ?string $bic = null;

    /**
     * The beneficiary bank name.
     *
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * The correspondent bank address.
     *
     * @var Address
     */
    protected Address $address;
}