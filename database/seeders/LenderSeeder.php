<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class LenderSeeder extends Seeder
{
    public function run()
    {
        $promotedLenders = [
            'Sunny / Quid / 1 Month Loan',
            'Payday UK / MEM',
            'Mr Lender',
            'QuickQuid',
            'Uncle Buck',
            'Wonga',
        ];

        $otherLenders = [
            '100Pounds',
            '247Moneybox',
            'CashASAP',
            'CashFloat',
            'CashGenieLoans',
            'CFOLending',
            'FancyaPayday',
            'Ferratum',
            'LauraLends',
            'LendingStream',
            'LifeboatLoans',
            'MiniCredit',
            'MoneyBoat',
            'MoneyShop',
            'MonkeyDosh',
            'MyJar',
            'MyMate',
            'PaydayExpress',
            'PaydayFirst',
            'Payday-United',
            'Peachy',
            'PiggyBank',
            'PixieLoans',
            'PoundsTillPayday',
            'SatsumaLoans',
            'SpeedyCash',
            'SwiftSterling',
            'TheQuickLoanShopLtd',
            'ToothFairyFinance',
            'TrustedQuid',
            'TxtMeCash',
            'UmbrellaLoans',
            'Vivus',
            'WageDayAdvance',
            'WageMe',
        ];

        $lenderData = array_merge(
            array_map(
                function ($name) {
                    return ['name' => $name, 'promoted' => true];
                },
                $promotedLenders
            ),
            array_map(
                function ($name) {
                    return ['name' => $name, 'promoted' => false];
                },
                $otherLenders
            )
        );
        DB::table('lenders')->insert($lenderData);
    }
}
