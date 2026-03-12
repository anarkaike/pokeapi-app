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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name'];
    
    /**
     * The pokemons that belong to this type.
     * 
     * @return BelongsToMany
     */
    public function pokemons() { 
        return $this->belongsToMany(Pokemon::class); 
    }
}
