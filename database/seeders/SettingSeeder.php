<?php

namespace Database\Seeders;

use App\Models\Setting;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Setting::factory()->count(1)->create()->each(function (Setting $setting) use ($faker) {
            $image_type = ['logo', 'footer_logo'];
            for ($i = 0; $i <= 1; $i++) {
                $setting->image()->create([
                    'url' => $faker->imageUrl(410, 104),
                    'type' => $image_type[$i],
                ]);
            }
        });
    }
}
