<?php

namespace Database\Seeders;

use App\Models\Agreement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agreements')->truncate();
        Agreement::forceCreate([
            'name'    => 'Contract',
            'key'     => 'contract',
            'content' => file_get_contents(
                resource_path('seed_agreements/contract.html')
            )
        ]);

        Agreement::forceCreate([
            'name'    => 'Letter of Authority',
            'key'     => 'loa',
            'content' => file_get_contents(
                resource_path('seed_agreements/loa.html')
            )
        ]);
    }
}
