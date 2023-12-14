<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Receita;
use Illuminate\Http\Request;
use App\Models\TipoReceita;
use Illuminate\Support\Facades\Cache;

class TipoReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });
        return view('private.lista_tipo_receitas', ['tiposReceitas' => $tiposReceitas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('private.cadastro_tipo_receita', ['tiposReceitas' => $tiposReceitas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);

        $tipoReceita = new TipoReceita();

        $regras = $tipoReceita->rules();
        $feedback = $tipoReceita->feedback();

        $request->validate($regras, $feedback);

        $tipoReceita->create($request->all());

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return redirect()->route('private.lista_tipo_receitas', ['tiposReceitas' => $tiposReceitas]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoReceita $tipoReceita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('private.cadastro_tipo_receita', ['tiposReceitas' => $tiposReceitas, 'tipoReceita' => $tipoReceita]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoReceita $tipoReceita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('private.cadastro_tipo_receita', ['tiposReceitas' => $tiposReceitas, 'tipoReceita' => $tipoReceita]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoReceita $tipoReceita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoReceita $tipoReceita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        //remove todos os favoritos com aquela receita para não dar inconsistência
        $receitas = Receita::where('tipo_receita_id', $tipoReceita->id);

        foreach($receitas as $receita)
        {
            $receita->delete();
        }

        $tipoReceita->delete();

        return redirect()->route('public.index', ['tiposReceitas' => $tiposReceitas]);
    }
}
