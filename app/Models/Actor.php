<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actor'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'country',
        'img_url',
    ];

    protected $dates = [
        'birthdate', // Indica que 'birthdate' debe tratarse como una fecha
    ];

    public $timestamps = true; // Habilitar timestamps (created_at y updated_at)

    // Relación muchos a muchos con Film
    public function films()
    {
        return $this->belongsToMany(Film::class, 'actor_film', 'actor_id', 'film_id')
                    ->withTimestamps();
    }
}