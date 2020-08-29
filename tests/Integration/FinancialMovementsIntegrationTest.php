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

namespace IBanFirst\Integration;

class FinancialMovementsIntegrationTest extends IntegrationTest
{
    public function testFinancialMovementsList(): void
    {
        $fixture = $this->loadJsonFixture('financial_movements')->list;

        $sdk = $this->createSDKAndMock(
            json_encode($body = $fixture->body)
        );

        $listResponse = $sdk->financialMovements()->getList();

        $this->assertCount(3, $records = $listResponse->getRecords());


        foreach (range(0, count($body->financialMovements) - 1) as $num) {
            $record = $records[$num];

            $this->assertEquals($body->financialMovements[$num]->id, $record->id);
            $this->assertEquals($body->financialMovements[$num]->amount->value, $record->amount->value);
            $this->assertEquals($body->financialMovements[$num]->amount->currency, $record->amount->currency);

            // add more asserts...
        }
    }

    public function testFinancialMovementDetails(): void
    {
        $fixture = $this->loadJsonFixture('financial_movements')->details;

        $sdk = $this->createSDKAndMock(
            json_encode($body = $fixture->body)
        );

        $movement = $sdk->financialMovements()->getDetails('MTE0OTQ4NA');

        $this->assertEquals($body->financialMovement->id, $movement->id);
        $this->assertEquals($body->financialMovement->walletId, $movement->walletId);
        $this->assertEquals($body->financialMovement->bookingDate, $movement->bookingDate);
        $this->assertEquals($body->financialMovement->valueDate, $movement->valueDate);
        $this->assertEquals($body->financialMovement->orderingAccountNumber, $movement->orderingAccountNumber);
        $this->assertEquals($body->financialMovement->beneficiaryAccountNumber, $movement->beneficiaryAccountNumber);
        $this->assertEquals($body->financialMovement->orderingCustomer, $movement->orderingCustomer);
        $this->assertEquals($body->financialMovement->orderingInstitution, $movement->orderingInstitution);
        $this->assertEquals($body->financialMovement->orderingAmount->value, $movement->orderingAmount->value);
        $this->assertEquals($body->financialMovement->orderingAmount->currency, $movement->orderingAmount->currency);
        $this->assertEquals($body->financialMovement->beneficiaryAmount->value, $movement->beneficiaryAmount->value);
        $this->assertEquals($body->financialMovement->beneficiaryAmount->currency, $movement->beneficiaryAmount->currency);

        // add more asserts...
    }
}