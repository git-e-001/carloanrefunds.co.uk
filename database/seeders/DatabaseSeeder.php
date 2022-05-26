<?php

namespace Database\Seeders;

use App\Models\Fontawesome;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminsSeeder::class,
            SettingSeeder::class,
            SlidersSeeder::class,
            UserTableSeeder::class,
            EventSeeder::class,
            FontawesomeSeeder::class,
            MenuSeeder::class,
            MenuItemSeeder::class,
            StateSeeder::class,
            AgreementSeeder::class,
            LenderSeeder::class,
            PageSeeder::class,
            SeoSeeder::class,
        ]);
    }
}
