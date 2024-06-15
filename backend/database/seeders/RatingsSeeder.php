<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ratings;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        //Ratings::truncate();

        for($i = 0; $i < 10; $i++){
            Ratings::create([
                'movie_id' => $faker->numberBetween(1, \App\Models\Movies::count()),
                'username' => $faker->username(),
                'rating' => $faker->numberBetween(1, 10),
                'description' => $faker->sentence(),
            ]);
        }
    }
}
