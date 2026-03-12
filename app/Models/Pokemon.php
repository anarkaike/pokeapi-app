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
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'api_id', 
        'name', 
        'height', 
        'weight', 
        'sprite_url'
    ];

    /**
     * The types that belong to the pokemon.
     *
     * @return BelongsToMany
     */
    public function types() {
        return $this->belongsToMany(Type::class);
    }

    /**
     * The abilities that belong to the pokemon.
     *
     * @return BelongsToMany
     */
    public function abilities() {
        return $this->belongsToMany(Ability::class, 'pokemon_ability');
    }

    /**
     * The moves that belong to the pokemon.
     *
     * @return BelongsToMany
     */
    public function moves() {
        return $this->belongsToMany(Move::class, 'pokemon_move');
    }

    /**
     * The users that have favorited the pokemon.
     *
     * @return BelongsToMany
     */
    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'user_favorites')->withTimestamps();
    }
}
