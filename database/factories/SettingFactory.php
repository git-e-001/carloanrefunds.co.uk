<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'header_top_title' => $this->faker->sentence(3),
            'description_one' => $this->faker->sentence(10),
            'description_two' => $this->faker->sentence(10),
            'site_top_bar_bg_color' => '63E175',
            'status' => random_int(0,1),
        ];
    }
}
