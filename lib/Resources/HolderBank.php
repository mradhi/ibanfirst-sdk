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
 * @property-read         $clearingCodeType
 * @property-read         $clearingCode
 * @property-read         $name
 * @property-read Address $address
 */
class HolderBank extends AbstractResource
{
    protected array $map = [
        'address' => Address::class
    ];

    /**
     * Eight or eleven-digit ISO 9362 Business Identifier Code specifying the Recipient Bank.
     * This field is optional only when the account number does not have an Iban format.
     *
     * @var string|null
     */
    protected ?string $bic = null;

    /**
     * The two-digit code specifying the local clearing network.
     * If you does not have a bic, this field is required.
     *
     * @var string|null
     */
    protected ?string $clearingCodeType = null;

    /**
     * The code identifying the branch number on the local clearing network.
     * If you does not have a bic, this field is required.
     *
     * @var string|null
     */
    protected ?string $clearingCode = null;

    /**
     * The beneficiary bank name.
     *
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * The beneficiary bank address.
     *
     * @var Address
     */
    protected Address $address;
}