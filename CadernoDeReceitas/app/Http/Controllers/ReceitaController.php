<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favorito;
use App\Models\Receita;
use App\Models\TipoReceita;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitaController extends Controller
{
    public function index(Request $request)
    {
        if($request->tipoReceita)
        {
            $receitas = Receita::where('tipo_receita_id', $request->tipoReceita)->paginate(10);
        }
        else
        {
            $receitas = Receita::paginate(10);
        }

        $tiposReceitas = TipoReceita::all();
        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }

    public function create()
    {
        $tiposReceitas = TipoReceita::all();
        return view('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas]);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $request->merge(['alcoolica' => isset($request->alcoolica), 'cadastrada_em' => date('Y/m/d H:i:s', time()), 'user_id' => auth()->user()->id]);

        // dd($request);

        $receita = new Receita();

        $regras = $receita->rules();
        $feedback = $receita->feedback();

        $request->validate($regras, $feedback);

        $receita->create($request->all());

        $tiposReceitas = TipoReceita::all();
        return redirect()->route('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $request->all()]);
    }

    public function show(Receita $receita)
    {
        $tiposReceitas = TipoReceita::all();
        return redirect()->route('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $receita]);
    }

    public function edit()
    {

    }

    public function update()
    {
        
    }

    public function destroy(Receita $receita)
    {
        //remove todos os favoritos com aquela receita para não dar inconsistência
        $favoritos = Favorito::where('receita_id', $receita->id);

        foreach($favoritos as $favorito)
        {
            $favorito->delete();
        }

        $receita->delete();

        return redirect()->route('home');
    }

    public function receitasUsuario()
    {
        $receitas = Receita::where('user_id', Auth::user()->id)->paginate(10);
        $tiposReceitas = TipoReceita::all();

        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }

    public function receitasFavoritas()
    {
        // $receitas = Receita::with('favoritada')->where('user_id', Auth::user()->id);
        $receitas = Receita::whereHas('favoritada', function (Builder $query) {
            $query->where('user_id', Auth::user()->id);
        });
        $tiposReceitas = TipoReceita::all();

        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }
}
