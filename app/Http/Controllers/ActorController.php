<?php

namespace App\Http\Controllers;

use App\Models\Actor; // Importar el modelo
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Read actors from database
     */
    public static function readActors(): array
    {
        // Leer actores desde la base de datos usando Eloquent
        return Actor::all()->toArray();
    }

    /**
     * Count total actors
     */
    public function countActors()
    {
        $title = "Actores disponibles";
        $actors = ActorController::readActors();

        return view("actors.actorscounter", ["actors" => count($actors), "title" => $title]);
    }

    /**
     * List all actors
     */
    public static function listActors()
    {
        $title = "Listado de todos los Actores";
        $actors = ActorController::readActors();

        return view('actors.list', ["actors" => $actors, "title" => $title]);
    }

    /**
     * Return actors as JSON with films
     */
    public function index()
    {
        // Obtener todos los actores con sus películas usando Eloquent
        $actors = Actor::with('films')->get();

        // Devolver la respuesta en formato JSON
        return response()->json($actors);
    }

    /**
     * List actors filtered by decade
     */
    public function listActorsByDecade(Request $request)
    {
        $title = "Listado de Actores por Década";

        // Iniciar consulta con Eloquent
        $query = Actor::query();

        if ($request->has('decade')) {
            $years = explode('-', $request->decade);
            $startYear = (int) $years[0];
            $endYear = (int) $years[1];

            $query->whereYear('birthdate', '>=', $startYear)
                  ->whereYear('birthdate', '<=', $endYear);
        }

        $actors = $query->get()->toArray();

        return view('actors.list', ['actors' => $actors, 'title' => $title]);
    }

    /**
     * Delete an actor by ID
     */
    public function destroy($id)
    {
        // Buscar el actor usando Eloquent
        $actor = Actor::find($id);

        if (!$actor) {
            return response()->json(['error' => 'Actor no encontrado.'], 404);
        }

        // Eliminar el actor
        $actor->delete();

        return response()->json(['success' => 'Actor eliminado correctamente.'], 200);
    }
}