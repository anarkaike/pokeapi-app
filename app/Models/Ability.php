<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ 
    Factories\HasFactory,
    Relations\BelongsToMany,
    Model, 
};

class Ability extends Model
{
    /** @use HasFactory<AbilityFactory> */
    use HasFactory;

    protected $table = 'abilities';

    protected $fillable = ['name'];

    public function pokemons() { 
        return $this->belongsToMany(Pokemon::class, 'pokemon_ability'); 
    }
}
