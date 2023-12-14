<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoReceita;
use App\Models\TipoReceita;
use App\Models\Favorito;
use App\Models\Receita;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AvaliacaoReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Receita $receita, $valor)
    {
        $avaliacaoAnterior = AvaliacaoReceita::where([['receita_id', $receita->id], ['user_id', auth()->user()->id]])->get();
        
        if(sizeof($avaliacaoAnterior) == 0)
        {
            $avaliacao = new AvaliacaoReceita();
            $avaliacao->create(['user_id' => auth()->user()->id, 'receita_id' => $receita->id, 'avaliacao' => $valor]);
        }
        else
        {
            $avaliacaoAnterior[0]->update(['avaliacao' => $valor]);
        }

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        if(isset(auth()->user()->id))
        {
            $favoritada = Favorito::where([['receita_id', $receita->id], ['user_id', auth()->user()->id]])->count() > 0 ? true : false;
        }
        else
        {
            $favoritada = false;
        }

        return view('public.apresentacao_receita', ['tiposReceitas' => $tiposReceitas,
                                                    'receita' => $receita,
                                                    'favoritada' => $favoritada,
                                                    'avaliacao' => sizeof($avaliacaoAnterior) == 0 ? $valor : $avaliacaoAnterior[0]->avaliacao,
                                                    'avaliacaoGeral' => $receita->avaliacaoReceita()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AvaliacaoReceita $avaliacaoReceita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AvaliacaoReceita $avaliacaoReceita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AvaliacaoReceita $avaliacaoReceita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvaliacaoReceita $avaliacaoReceita)
    {
        //
    }
}
