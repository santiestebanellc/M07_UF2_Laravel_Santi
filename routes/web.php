<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['validate_url'])->group(function() {
    Route::post('filmin/createFilm', [FilmController::class, 'createFilm'])->name('createFilm');
});

Route::get('/img/{filename}', function ($filename) {
    return response()->file(storage_path("app/public/img/{$filename}"));
});

Route::middleware('year')->group(function() {
    Route::group(['prefix'=>'filmout'], function(){
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
        
        Route::get('films/year/{year?}', [FilmController::class, "listFilmsByYear"])->name('listFilmsByYear');
        Route::get('films/genre/{genre?}', [FilmController::class, "listFilmsByGenre"])->name('listFilmsByGenre');
        
        Route::get('countFilms/', [FilmController::class, "countFilms"])->name('countFilms');
        Route::get('sortFilms/', [FilmController::class, "sortFilms"])->name('sortFilmsByYear');
    });
});

Route::group(['prefix'=>'actorout'], function(){
    Route::get('countActors/', [ActorController::class, "countActors"])->name('countActors');
    Route::get('actors/', [ActorController::class, "listActors"])->name('listActors');
});
