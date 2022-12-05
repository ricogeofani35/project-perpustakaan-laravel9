<?php

namespace Database\Seeders;

// plugin faker

use App\Models\Publisher;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i <= 20; $i++) {
            Publisher::create([
                'name'          => $faker->name(),
                'email'         => $faker->email(),
                'phone_number'  => '088'.$faker->randomNumber(8),
                'address'       => $faker->address()
            ]);
        }
    }
}
