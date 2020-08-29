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
 * @property-read                   $id
 * @property-read                   $currency
 * @property-read                   $tag
 * @property-read                   $status
 * @property-read                   $accountNumber
 * @property-read CorrespondentBank $correspondentBank
 * @property-read HolderBank        $holderBank
 * @property-read Holder            $holder
 */
class WalletDetails extends AbstractResource
{
    protected array $map = [
        'correspondentBank' => CorrespondentBank::class,
        'holderBank' => HolderBank::class,
        'holder' => Holder::class
    ];

    /**
     * The code identifying of the account.
     *
     * @var string
     */
    protected string $id;

    /**
     * The three-digit code specifying the currency of the account.
     *
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Custom reference associated to this wallet. (For internal use only, not communicated to any beneficiary).
     *
     * @var string|null
     */
    protected ?string $tag = null;

    /**
     * The code identifying the status of the account.
     *
     * Can be {authorized}, {locked} or {not authorized}
     *
     * @var string
     */
    protected string $status;

    /**
     * Iban or account number.
     *
     * @var string|null
     */
    protected ?string $accountNumber = null;

    /**
     * The intermediary bank details, used to reach the beneficiary bank.
     *
     * @var CorrespondentBank
     */
    protected CorrespondentBank $correspondentBank;

    /**
     * The recipient bank details, holding the account.
     *
     * @var HolderBank
     */
    protected HolderBank $holderBank;

    /**
     * The recipient details, owner of the account.
     *
     * @var Holder
     */
    protected Holder $holder;
}