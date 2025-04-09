<?php

namespace App\Http\Controllers;

use App\Models\Film; // Importar el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Read films from storage (JSON and DB)
     */
    public static function readFilms(): array
    {
        // Leer las películas desde el archivo JSON
        $filmsFromJson = json_decode(Storage::get('public/films.json'), true) ?? [];

        // Leer las películas desde la base de datos usando Eloquent
        $filmsFromDB = Film::all()->toArray();

        // Combinar ambas listas
        return array_merge($filmsFromJson, $filmsFromDB);
    }

    /**
     * List films older than input year
     * If year is not informed, 2000 will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        $old_films = array_filter($films, fn($film) => $film['year'] < $year);

        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    /**
     * List films newer than input year
     * If year is not informed, 2000 will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        $new_films = array_filter($films, fn($film) => $film['year'] >= $year);

        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    /**
     * Count total films
     */
    public function countFilms()
    {
        $title = "Películas disponibles";
        $films = FilmController::readFilms();

        return view("films.filmscounter", ["films" => count($films), "title" => $title]);
    }

    /**
     * List films sorted by year
     */
    public function sortFilms()
    {
        $title = "Pelis ordenadas por año";

        // Obtener películas ordenadas por año usando Eloquent
        $films = Film::orderBy('year', 'asc')->get()->toArray();

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    /**
     * List films filtered by year
     */
    public function listFilmsByYear()
    {
        $year = request()->input('year');
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        if (empty($year)) {
            return view('films.list', ["films" => $films, "title" => $title]);
        }

        $films_filtered = array_filter($films, fn($film) => $film['year'] == $year);
        $title = "Listado de todas las pelis filtrado por año: $year";

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * List films filtered by genre
     */
    public function listFilmsByGenre()
    {
        $genre = request()->input('genre');
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        if (empty($genre)) {
            return view('films.list', ["films" => $films, "title" => $title]);
        }

        $films_filtered = array_filter($films, fn($film) => strtolower($film['genre']) == strtolower($genre));
        $title = "Listado de todas las pelis filtrado por género: $genre";

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Create a new film
     */
    public function createFilm(Request $request)
    {
        $storageType = env('FILM_STORAGE', 'JSON'); // Leer la variable de entorno

        $newFilm = [
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'genre' => $request->input('genre'),
            'country' => $request->input('country'),
            'duration' => $request->input('duration'),
            'img_url' => $request->input('img_url'),
        ];

        // Verificar si la película ya existe
        if ($this->isFilm($newFilm['name'])) {
            return redirect('/')->withErrors(['name' => 'La película ya existe']);
        }

        if ($storageType === 'DDBB') {
            // Guardar en la base de datos usando Eloquent
            Film::create($newFilm);
        } else {
            // Guardar en el JSON
            $films = self::readFilms();
            $films[] = $newFilm;
            file_put_contents(storage_path('app/public/films.json'), json_encode($films, JSON_PRETTY_PRINT));
        }

        return redirect('/filmout/sortFilms')->with('success', 'Película añadida correctamente');
    }

    public function index()
    {
        // Obtener todas las películas con sus actores usando Eloquent
        $filmsFromDB = Film::with('actors')->get();

        // Obtener las películas del JSON (si las hay)
        $filmsFromJson = json_decode(Storage::get('public/films.json'), true) ?? [];

        // Combinar las películas del JSON con las de la base de datos
        $films = $filmsFromDB->toArray();
        $allFilms = array_merge($filmsFromJson, $films);

        // Devolver la respuesta en formato JSON
        return response()->json($allFilms);
    }

    /**
     * Check if a film exists by name
     */
    public function isFilm($filmName)
    {
        $films = self::readFilms();

        foreach ($films as $film) {
            if (strcasecmp($film['name'], $filmName) == 0) {
                return true;
            }
        }
        return false;
    }
}