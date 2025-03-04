<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filmIds = DB::table('film')->pluck('id')->toArray();
        $actorIds = DB::table('actor')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            $actorsToAssign = collect($actorIds)->random(rand(1, 3));
            
            foreach ($actorsToAssign as $actorId) {
                DB::table('actor_film')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
