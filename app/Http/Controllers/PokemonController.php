<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Pokemon;
use App\Http\Requests\ImportPokemonRequest;
use App\Contracts\PokeApiInterface;
use App\Jobs\SyncPokemonJob;
use App\Services\{ PokemonService, PokeApiClient, PokemonImporter };

class PokemonController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected PokeApiInterface $apiClient,
        protected PokemonImporter  $importer,
        protected PokemonService   $pokemonService,
    ) {}

    public function index(Request $request, PokeApiClient $client)
    {
        $this->authorize('viewAny', Pokemon::class);

        $selected      = $request->query('selected');
        $pokemonDetail = null;
        $page          = (int) $request->input('page', 1);
        $search        = strtolower(trim($request->input('search', '')));
        $showFavorites = $request->boolean('favorites');
        $syncStatus    = $request->input('sync_status', 'all');
        $limit         = 12;

        try {
            $data          = $this->pokemonService->getList($search, $showFavorites, $syncStatus, $page, $limit);
            $names         = collect($data['results'])->pluck('name')->toArray();
            $localPokemons = $this->pokemonService->getLocalPokemonsByNames($names);

            if ($selected) {
                $pokemonDetail = $client->getPokemon($selected);
            }
            return view('pages.pokemons', [
                'pokemons'      => $data['results'],
                'pokemonDetail' => $pokemonDetail,
                'localPokemons' => $localPokemons,
                'count'         => $data['count'],
                'currentPage'   => $page,
                'totalPages'    => $data['totalPages']
            ]);

        } catch (\Exception $e) {
            return view('pages.pokemons')->with('error', 'Erro ao carregar lista de Pokémons.');
        }
    }

    public function show($identifier)
    {
        try {
            $this->authorize('view', Pokemon::class);

            $pokemonData = $this->apiClient->fetchPokemon($identifier);
            $local       = Pokemon::where('name', $identifier)->first();

            if ($local) {
                $this->authorize('view', $local);
            }

            return view('pages.pokemon-detail', compact('pokemonData', 'local'));
        } catch (\Exception $e) {
            return redirect()->route('pokemons.index')->with('error', 'Pokémon não encontrado.');
        }
    }

    public function sync(ImportPokemonRequest $request, PokeApiInterface $apiClient, PokemonImporter $importer)
    {
        $this->authorize('import', Pokemon::class);

        try {
            $pokemonData = $apiClient->fetchPokemon($request->validated('name'));
            $pokemon     = $importer->import($pokemonData);

            return redirect()->back()->with('success', "{$pokemon->name} foi sincronizado com sucesso!");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao sincronizar Pokémon.');
        }
    }
    public function syncAll()
    {
        $this->authorize('import', Pokemon::class);

        $allNames = $this->apiClient->fetchList(2000, 0)['results'];

        foreach ($allNames as $p) {
            SyncPokemonJob::dispatch($p['name']);
        }

        return redirect()->back()->with('success', 'Sincronização em massa iniciada! Os Pokémons aparecerão conforme o processamento terminar.');
    }

    public function syncProgress()
    {
        return response()->json($this->pokemonService->getSyncProgress());
    }

    public function destroy(Pokemon $pokemon)
    {
        $this->authorize('delete', $pokemon);
        $pokemon->delete();
        return redirect()->back()->with('success', 'Pokémon removido do banco local.');
    }

    public function toggleFavorite(Pokemon $pokemon)
    {
        $this->authorize('favorite', $pokemon);
        Auth::user()->favorites()->toggle($pokemon->id);
        return redirect()->back()->with('success', 'Sua lista de favoritos foi atualizada!');
    }
}
