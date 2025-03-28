<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        // Leer las películas desde el archivo JSON
        $filmsFromJson = json_decode(Storage::get('public/films.json'), true) ?? [];
    
        // Leer las películas desde la base de datos
        $filmsFromDB = DB::table('film')->select('name', 'year', 'genre', 'country', 'duration', 'img_url')->get()->toArray();
    
        // Convertir las películas de la base de datos a un formato de array asociativo
        $filmsFromDB = array_map(fn($film) => (array) $film, $filmsFromDB);
    
        // Combinar ambas listas
        return array_merge($filmsFromJson, $filmsFromDB);
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function countFilms()
    {
        $title = "Peliculas disponibles";
        $films = FilmController::readFilms();
        return view("films.filmscounter", ["films" => count($films), "title" => $title]);
    }

    public function sortFilms()
    {
        $title = "Pelis ordenadas por año";
    
        // Obtener películas desde la base de datos, ordenadas por año
        $films = DB::table('film')->orderBy('year', 'asc')->get();
    
        // Convertir a array asociativo para la vista
        $filmsArray = array_map(function ($film) {
            return (array) $film;
        }, $films->toArray());
    
        return view("films.list", ["films" => $filmsArray, "title" => $title]);
    }

    public function listFilmsByYear()
    {
        $year = request()->input('year'); // Obtener el año desde el request
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        if (empty($year)) {
            return view('films.list', ["films" => $films, "title" => $title]);
        }

        foreach ($films as $film) {
            if ($film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado por año: $year";
                $films_filtered[] = $film;
            }
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

public function listFilmsByGenre()
{
    $genre = request()->input('genre'); // Obtener el género desde el request
    $films_filtered = [];

    $title = "Listado de todas las pelis";
    $films = FilmController::readFilms();

    if (empty($genre)) {
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    foreach ($films as $film) {
        if (strtolower($film['genre']) == strtolower($genre)) {
            $title = "Listado de todas las pelis filtrado por género: $genre";
            $films_filtered[] = $film;
        }
    }

    return view("films.list", ["films" => $films_filtered, "title" => $title]);
}

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

    // Si la película ya existe, redirigir con error
    if ($this->isFilm($newFilm['name'])) {
        return redirect('/')->withErrors(['name' => 'La película ya existe']);
    }

    if ($storageType === 'DDBB') {
        // Guardar en la base de datos
        DB::table('film')->insert($newFilm);
    } else {
        // Guardar en el JSON
        $films = self::readFilms();
        $films[] = $newFilm;
        file_put_contents(storage_path('app/public/films.json'), json_encode($films, JSON_PRETTY_PRINT));
    }

    return redirect('/filmout/sortFilms')->with('success', 'Película añadida correctamente');
}


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
