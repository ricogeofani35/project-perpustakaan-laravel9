<?php

namespace Database\Seeders;

// plugin faker

use App\Models\Book;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i <= 30; $i++) {
            Book::create([
                'isbn'          => '00'.$i.$faker->randomNumber(3),
                'title'         => $faker->word(),
                'year'          => $faker->year(),
                'publisher_id'  => rand(1, 20),
                'author_id'     => rand(1, 20),
                'catalog_id'    => rand(1, 10),
                'qty'           => $faker->randomNumber(2, true),
                'price'         => $faker->randomNumber(6, true),
            ]);
        }
    }
}
