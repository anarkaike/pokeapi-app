<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ 
    Factories\HasFactory,
    Relations\BelongsToMany,
    Model, 
};

class Move extends Model
{
    /** @use HasFactory<MoveFactory> */
    use HasFactory;

    protected $table = 'moves';

    protected $fillable = ['name'];

    public function pokemons() { 
        return $this->belongsToMany(Pokemon::class, 'pokemon_move'); 
    }
}
