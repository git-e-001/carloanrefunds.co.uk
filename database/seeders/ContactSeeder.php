<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'address'   => 'Dhanmondi, 1205 Dhaka, Bangladesh.',
            'phone_1'   => '01187563452',
            'phone_2'   => '01187563452',
            'telephone' => '08657',
            'email'     => 'example@gmail.com',
            'fax'       => '05648657',
        ]);
    }
}
