<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url',
    ];

    public $timestamps = true; // Habilitar timestamps (created_at y updated_at)
}