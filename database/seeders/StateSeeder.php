<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'I am still paying it in accordance with the loan agreement.',
            'I have repaid it in accordance with the loan agreement.',
            'I am still repaying it but on a reduced payment plan arrangement.',
            'I have repaid it, but on a reduced payment plan arrangement.',
            'I still owe the lender money but am not paying anything at the moment.',
            'The loan was written off.',
            'None of these describes it sufficiently enough.'
        ];

        $statesData = array_map(
            function ($state) {
                return [ 'description' => $state ];
            },
            $states
        );
        DB::table('states')->insert($statesData);
    }
}
