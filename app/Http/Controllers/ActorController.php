<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    public static function readActors(): array {

        $actors = DB::table('actor')->get()->toArray();

        return $actors;
    }
    
    public function countActors()
    {
        $title = "Actores disponibles";
        $actors = ActorController::readActors();
        return view("actors.actorscounter", ["actors" => count($actors), "title" => $title]);
    }

    public static function listActors()
    {
        $title = "Listado de todos los Actores";
        $actors = ActorController::readActors();

        $actors = array_map(fn($actor) => (array) $actor, $actors);

        return view('actors.list', ["actors" => $actors, "title" => $title]);
    }

    public function listActorsByDecade(Request $request)
    {
        $title = "Listado de Actores por Década";
        $query = DB::table('actor');

        if ($request->has('decade')) {
            $years = explode('-', $request->decade);
            $startYear = (int) $years[0];
            $endYear = (int) $years[1];

            $query->whereYear('birthdate', '>=', $startYear)
                ->whereYear('birthdate', '<=', $endYear);
        }

        $actors = $query->get()->toArray();
        $actors = array_map(fn($actor) => (array) $actor, $actors);

        return view('actors.list', ['actors' => $actors, 'title' => $title]);
    }

    public function destroy($id)
    {
        // Verificar si el actor existe en la base de datos
        $actor = DB::table('actor')->where('id', $id)->first();

        if (!$actor) {
            return response()->json(['error' => 'Actor no encontrado.'], 404);
        }

        // Eliminar el actor utilizando el Query Builder
        DB::table('actor')->where('id', $id)->delete();

        // Respuesta exitosa
        return response()->json(['success' => 'Actor eliminado correctamente.'], 200);
    }



}
