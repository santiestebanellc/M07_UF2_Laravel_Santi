<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'film';

    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url',
    ];

    public $timestamps = true;

    // Relación muchos a muchos con Actor
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_film', 'film_id', 'actor_id')
                    ->withTimestamps();
    }
}