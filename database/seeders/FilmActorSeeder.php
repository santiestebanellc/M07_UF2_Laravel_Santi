<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Actor;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los IDs de películas y actores
        $filmIds = Film::pluck('id')->toArray();
        $actorIds = Actor::pluck('id')->toArray();

        // Asignar actores a cada película
        foreach ($filmIds as $filmId) {
            $film = Film::find($filmId);
            $actorsToAssign = collect($actorIds)->random(rand(1, 3))->toArray();

            // Usar la relación para asociar actores a la película
            $film->actors()->attach($actorsToAssign, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}