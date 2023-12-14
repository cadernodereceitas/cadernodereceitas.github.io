<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AvaliacaoReceita;
use App\Models\Favorito;
use App\Models\ImagemReceita;
use App\Models\Receita;
use App\Models\TipoReceita;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReceitaController extends Controller
{
    public function index(Request $request)
    {
        if($request->tipoReceita)
        {
            $receitas = Receita::where('tipo_receita_id', $request->tipoReceita)->where('aprovada_por', '!=', null)->paginate(10);
        }
        else
        {
            $receitas = Receita::where('aprovada_por', '!=', null)->paginate(10);
        }

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });
        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }

    public function create()
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas]);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $request->merge(['alcoolica' => isset($request->alcoolica), 'cadastrada_em' => date('Y/m/d H:i:s', time()), 'user_id' => auth()->user()->id]);

        $receita = new Receita();

        $regras = $receita->rules();
        $feedback = $receita->feedback();

        $request->validate($regras, $feedback);

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $receita = $receita->create($request->all());

        $imagemSalva = new ImagemReceita();
        $imagemSalva->create(['receita_id' => $receita->id, 'imagem' => $imagem_urn ]);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return redirect()->route('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $request->all(), 'favoritada' => false]);
    }

    public function show(Receita $receita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        if($receita->aprovada_por == null && (!(auth()->user()->userAdmin || auth()->user()->superUser) || !isset(auth()->user()->id)))
        {
            return redirect()->route('home');
        }

        if(isset(auth()->user()->id))
        {
            $favoritada = Favorito::where([['receita_id', $receita->id], ['user_id', auth()->user()->id]])->count() > 0 ? true : false;
            $avaliacao = AvaliacaoReceita::where([['receita_id', $receita->id], ['user_id', auth()->user()->id]])->get();
        }
        else
        {
            $favoritada = false;
            $avaliacao = 0;
        }

        return view('public.apresentacao_receita', ['tiposReceitas' => $tiposReceitas,
                                                    'receita' => $receita,
                                                    'favoritada' => $favoritada,
                                                    'avaliacao' => sizeof($avaliacao) > 0 ? $avaliacao[0]->avaliacao : 0,
                                                    'avaliacaoGeral' => $receita->avaliacaoReceita()]);
    }

    public function edit(Receita $receita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        if($receita->user_id != auth()->user()->id)
        {
            return redirect()->route('public.index', ['tiposReceitas' => $tiposReceitas]);
        }

        return view('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $receita]);
    }

    public function update(Request $request, Receita $receita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        if(!$receita->user_id == auth()->user()->id)
        {
            return redirect()->route('public.index', ['tiposReceitas' => $tiposReceitas]);
        }

        $receita->update($request->all());

        return view('private.cadastro_receita', ['tiposReceitas' => $tiposReceitas, 'receita' => $receita]);
    }

    public function destroy(Receita $receita)
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        if($receita->user_id != auth()->user()->id)
        {
            return redirect()->route('public.index', ['tiposReceitas' => $tiposReceitas]);
        }

        //remove todos os favoritos com aquela receita para não dar inconsistência
        $favoritos = Favorito::where('receita_id', $receita->id);

        foreach($favoritos as $favorito)
        {
            $favorito->delete();
        }

        $receita->delete();

        return redirect()->route('public.index', ['tiposReceitas' => $tiposReceitas]);
    }

    public function receitasUsuario()
    {
        $receitas = Receita::where('user_id', Auth::user()->id)->paginate(10);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }

    public function avaliarReceitas()
    {
        $receitas = Receita::where('aprovada_por', null)->paginate(10);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('public.lista_receitas', ['tiposReceitas' => $tiposReceitas, 'receitas' => $receitas]);
    }

    public function aprovarReceita(Receita $receita)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $receita->aprovada_por = auth()->user()->id;
        $receita->aprovada_em = date('Y/m/d H:i:s', time());

        $receita->update();

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return redirect()->route('public.receita',['tiposReceitas' => $tiposReceitas, 'receita' => $receita, 'favoritada' => false]);
    }
}
