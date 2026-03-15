<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ 
    Factories\HasFactory,
    Relations\BelongsToMany,
    Model, 
};

class Pokemon extends Model
{
    /** @use HasFactory<PokemonFactory> */
    use HasFactory;

    protected $table = 'pokemons';
    
    protected $fillable = [
        'api_id', 
        'name', 
        'height', 
        'weight', 
        'sprite_url',
        'synced_at',
    ];

    protected $casts = [
        'synced_at'   => 'datetime',
    ];

    public function types() {
        return $this->belongsToMany(Type::class);
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class, 'pokemon_ability');
    }

    public function moves() {
        return $this->belongsToMany(Move::class, 'pokemon_move');
    }

    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'user_favorites')->withTimestamps();
    }
}
