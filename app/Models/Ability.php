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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name'];

    /**
     * The pokemons that have this ability.
     *
     * @return BelongsToMany
     */
    public function pokemons() { 
        return $this->belongsToMany(Pokemon::class, 'pokemon_ability'); 
    }
}
