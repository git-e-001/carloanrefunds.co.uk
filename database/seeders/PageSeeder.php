<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title'   => 'welcome-page',
            'slug'    => 'welcome-page',
            'status'  => 1,
            'is_home' => 0,
        ]);
    }
}
