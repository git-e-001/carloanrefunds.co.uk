<?php

namespace Database\Seeders;

use App\Models\Slider;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Slider::factory()->count(10)->create()->each(function (Slider $slider) use($faker){
                $slider->image()->create([
                    'url' => $faker->imageUrl(1200,400)
                ]);
        });
    }
}
