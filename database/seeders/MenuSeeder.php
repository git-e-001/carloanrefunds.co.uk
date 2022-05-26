<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'backend' => ['Backend Left Menu'],
            'frontend' => ['Frontend Header', 'Frontend Footer First', 'Frontend Footer Second'],
        ];

        foreach ($names as $key => $name){
            foreach ($name as $n){
                Menu::updateOrCreate([
                    'site' => $key,
                    'name' => $n,
                ]);
            }
        }
    }
}
