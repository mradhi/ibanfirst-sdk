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

class WalletsIntegrationTest extends IntegrationTest
{
    public function testWalletsList(): void
    {
        $fixture = $this->loadJsonFixture('wallets')->list;

        $sdk = $this->createSDKAndMock(
            json_encode($body = $fixture->body)
        );

        $listResponse = $sdk->wallets()->getList();

        $this->assertCount(3, $records = $listResponse->getRecords());


        foreach (range(0, count($body->wallets) - 1) as $num) {
            $record = $records[$num];

            $this->assertEquals($body->wallets[$num]->id, $record->id);
            $this->assertEquals($body->wallets[$num]->tag, $record->tag);
            $this->assertEquals($body->wallets[$num]->currency, $record->currency);
            $this->assertEquals($body->wallets[$num]->bookingAmount->value, $record->bookingAmount->value);
            $this->assertEquals($body->wallets[$num]->bookingAmount->currency, $record->bookingAmount->currency);
            $this->assertEquals($body->wallets[$num]->valueAmount->value, $record->valueAmount->value);
            $this->assertEquals($body->wallets[$num]->valueAmount->currency, $record->valueAmount->currency);
            $this->assertEquals($body->wallets[$num]->dateLastFinancialMovement, $record->dateLastFinancialMovement);
        }
    }

    public function testWalletDetails(): void
    {
        $fixture = $this->loadJsonFixture('wallets')->details;

        $sdk = $this->createSDKAndMock(
            json_encode($body = $fixture->body)
        );

        $wallet = $sdk->wallets()->getDetails('NDgyODM');

        $this->assertEquals($body->wallet->id, $wallet->id);
        $this->assertEquals($body->wallet->currency, $wallet->currency);
        $this->assertEquals($body->wallet->tag, $wallet->tag);
        $this->assertEquals($body->wallet->status, $wallet->status);
        $this->assertEquals($body->wallet->accountNumber, $wallet->accountNumber);
        $this->assertEquals($body->wallet->correspondentBank->bic, $wallet->correspondentBank->bic);

        // add more asserts...
    }
}