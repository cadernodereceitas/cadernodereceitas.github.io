<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\TipoReceita;
use App\Models\Receita;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receitasFavoritadas = Favorito::with('receitas')->where('user_id', auth()->user()->id)->get();

        $receitas = array();

        foreach($receitasFavoritadas as $att)
        {
            array_push($receitas, $att->receitas);
        }
        
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Receita $receita)
    {
        $favoritada = new Favorito();
        $favoritada->create(['user_id' => auth()->user()->id, 'receita_id' => $receita->id]);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('public.apresentacao_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $receita, 'favoritada' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorito $favorito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorito $favorito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorito $favorito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receita $receita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        $favoritada = Favorito::where('receita_id', $receita->id)->where('user_id', auth()->user()->id);

        $favoritada->delete();

        return view('public.apresentacao_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $receita, 'favoritada' => false]);
    }
}
