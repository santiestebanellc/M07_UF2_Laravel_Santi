<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    public static function readActors(): array {

        
        // Fetch all actors from the 'actors' table
        $actors = DB::table('actors')->get()->toArray();

        return $actors;
    }
    
    public function countActors()
    {
        $title = "Actores disponibles";
        $actors = ActorController::readActors();
        return view("actors.actorscounter", ["actors" => count($actors), "title" => $title]);
    }

}
