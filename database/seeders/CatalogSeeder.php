<?php

namespace Database\Seeders;

// plugin faker

use App\Models\Catalog;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 0;$i <= 10; $i++){
            Catalog::create([
                'name'      => $faker->word()
            ]);
        }
    }
}
