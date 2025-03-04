<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('film')->insert([
                'name' => $faker->sentence(3),
                'year' => $faker->year(),
                'genre' => $faker->word(),
                'country' => $faker->country(),
                'duration' => $faker->numberBetween(80, 180),
                'img_url' => $faker->imageUrl(640, 480, 'movies'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}