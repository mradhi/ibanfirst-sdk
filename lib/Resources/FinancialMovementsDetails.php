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
 * @property-read        $walletId
 * @property-read        $bookingDate
 * @property-read        $valueDate
 * @property-read        $orderingAccountNumber
 * @property-read        $orderingCustomer
 * @property-read        $orderingInstitution
 * @property-read Amount $orderingAmount
 * @property-read        $beneficiaryAccountNumber
 * @property-read        $beneficiaryCustomer
 * @property-read        $beneficiaryInstitution
 * @property-read Amount $beneficiaryAmount
 * @property-read        $remittanceInformation
 * @property-read        $chargesDetails
 * @property-read        $exchangeRate
 * @property-read        $typeLabel
 * @property-read        $internalReference
 * @property-read        $description
 */
class FinancialMovementsDetails extends AbstractResource
{
    protected array $map = [
        'orderingAmount' => Amount::class,
        'beneficiaryAmount' => Amount::class
    ];

    /**
     * The code identifying the transfer.
     *
     * @var string
     */
    protected string $id;

    /**
     * The wallet ID.
     *
     * @var string|null
     */
    protected ?string $walletId;

    /**
     * The booking date of the transfer.
     *
     * @var string|null
     */
    protected ?string $bookingDate = null;

    /**
     * The value date of the transfer.
     *
     * @var string|null
     */
    protected ?string $valueDate = null;

    /**
     * The number referring the ordering account of the transfer.
     *
     * @var string|null
     */
    protected ?string $orderingAccountNumber = null;

    /**
     * A free formatted String representing the ordering customer with it's name and it's address.
     *
     * @var string|null
     */
    protected ?string $orderingCustomer = null;

    /**
     * A free formatted String representing the ordering institution with it's name and it's address.
     *
     * @var string|null
     */
    protected ?string $orderingInstitution = null;

    /**
     * The amount instructed by the ordering customer of the transfer.
     *
     * @var Amount
     */
    protected Amount $orderingAmount;

    /**
     * The number referring the beneficiary account.
     *
     * @var string|null
     */
    protected ?string $beneficiaryAccountNumber = null;

    /**
     * A free formatted String representing the beneficiary customer with it's name and it's address.
     *
     * @var string|null
     */
    protected ?string $beneficiaryCustomer = null;

    /**
     * A free formatted String representing the beneficiary institution with it's name and it's address.
     *
     * @var string|null
     */
    protected ?string $beneficiaryInstitution = null;

    /**
     * The amount delivered credited in the beneficiary account.
     *
     * @var Amount
     */
    protected Amount $beneficiaryAmount;

    /**
     * The communication field.
     *
     * @var string|null
     */
    protected ?string $remittanceInformation = null;

    /**
     * The charges details related to the transfer.
     *
     * @var string|null
     */
    protected ?string $chargesDetails = null;

    /**
     * The exchange rate applied on the transfer.
     *
     * @var string|null
     */
    protected ?string $exchangeRate = null;

    /**
     * The type of the financial movement, it may contains:
     * {rejectOperation}: Payment returned by the bank counterparty
     * {DebitForExchange}: Debit for an FX operation
     * {DebitForTransfer}: Debit linked to a transfer
     * {CreditForExchange}: Credit linked to an FX operation
     * {Immobilize}: Payment registered but not debited on value date
     * {ExternalCounterpartCredit}: Account credit
     * {debitForAccountGuaranteeCredit}: Movement related to the deposit for forward exchange transaction
     * {debitAccountGuarantee}: Movement related to the deposit for forward exchange transaction
     * {internalGuaranteeTransfer}: Movement related to the deposit for forward exchange transaction
     * {corrective}: Corrective
     * {rejectCreditDepositAccount}: Rejection of a flow credited to the account / after liquidation
     * {returnFund}: Payment returned by the recipient counterparty
     * {rejectDebit}: Rejection of an automatic debit on iBanFirst account (SDD)
     * {PrepaidCardDepositAccountDebit}: Initialization of a virtual payment card
     * {PrepaidCardDepositAccountCredit}: Recredit funds stored on a virtual payment card that expires
     * {clientFee}: Fees for using iBanFirst accounts
     * {cancelClientFee}: Commercial gesture
     * {DirectDebit}: Direct debit on iBanFirst account
     *
     * @var string|null
     */
    protected ?string $typeLabel = null;

    /**
     * Internal Reference of the financial movement.
     *
     * @var string|null
     */
    protected ?string $internalReference = null;

    /**
     * Description of the financial movement.
     *
     * @var string|null
     */
    protected ?string $description = null;
}