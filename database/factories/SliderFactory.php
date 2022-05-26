<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence;
        return [
            'title' => $name,
            'description' => $this->faker->paragraph(1, true),
            'btn_text' => $this->faker->word,
            'btn_link' => $this->faker->url,
            'btn_color' => $this->faker->hexColor,
            'status' => random_int(0, 1),
        ];
    }
}
