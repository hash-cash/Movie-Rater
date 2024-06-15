<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MoviesSeeder::class);
        $this->call(TimeslotsSeeder::class);
        $this->call(PerformersSeeder::class);
        $this->call(RatingsSeeder::class);
    }
}
