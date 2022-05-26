<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => \Hash::make('secret'),
            'type' => null,
        ]);

        $admin->image()->create([
            'url' => 'default.png',
            'base_path' => 'default.png',
            'type' => 'default.png',
        ]);
    }
}
