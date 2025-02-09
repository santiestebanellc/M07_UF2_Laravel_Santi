<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
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
        $films = FilmController::readFilms();
        usort($films, function ($a, $b) {
            return $a['year'] - $b['year'];
        });
        return view("films.list", ["films" => $films, "title" => $title]);
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



}
