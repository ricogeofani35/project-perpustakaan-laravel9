<?php

namespace Database\Seeders;

// use plugins factory
use App\Models\Author;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generete data indonesia
        $faker = Faker::create('id_ID');

        for($i = 0;$i <= 20; $i++) {
            // eloquond create data from database
            Author::create([
                // column => data faker
                'name'          => $faker->name(),
                'email'         => $faker->email(),
                'phone_number'  => '088'.$faker->randomNumber(8),
                'address'       => $faker->address()
            ]);
        }

    }
}
