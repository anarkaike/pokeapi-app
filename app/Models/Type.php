<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ 
    Factories\HasFactory,
    Relations\BelongsToMany,
    Model,
};

class Type extends Model
{
    /** @use HasFactory<TypeFactory> */
    use HasFactory;

    protected $table = 'types';

    protected $fillable = ['name'];
    
    public function pokemons() { 
        return $this->belongsToMany(Pokemon::class); 
    }
}
