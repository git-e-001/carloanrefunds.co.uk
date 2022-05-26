<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;
use App\Models\User;
use Database\Factories\OrderFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::factory()->count(10)->create()->each(function (User $user) use($faker){
            $user->image()->create([
                'url' => $faker->imageUrl(1200,400)
            ]);
        });
    }
}
