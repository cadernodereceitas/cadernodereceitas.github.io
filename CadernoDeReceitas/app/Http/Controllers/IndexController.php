<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoReceita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function home()
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('public.index', ['tiposReceitas' => $tiposReceitas]);
    }
}
