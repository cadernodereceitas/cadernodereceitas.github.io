<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoReceita;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $tiposReceitas = TipoReceita::all();
        return view('public.index', ['tiposReceitas' => $tiposReceitas]);
        // return view('public.index');
    }
}
