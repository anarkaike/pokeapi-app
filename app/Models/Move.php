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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name'];

    /**
     * The pokemons that have this move.
     *
     * @return BelongsToMany
     */
    public function pokemons() { 
        return $this->belongsToMany(Pokemon::class, 'pokemon_move'); 
    }
}
