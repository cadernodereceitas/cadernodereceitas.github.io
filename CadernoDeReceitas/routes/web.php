<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\IndexController::class, 'home'])->name('home');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'paginaLogin'])->name('public.login');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('public.login');

Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('public.register');

Route::get('/receitas/{tipoReceita?}', [\App\Http\Controllers\ReceitaController::class, 'index'])->name('public.lista_receitas');

Route::get('/receita/detalhes/{receita?}', [\App\Http\Controllers\ReceitaController::class, 'show'])->name('public.receita');


#--------------------------Rotas privadas


Route::get('/receita/cadastro', [\App\Http\Controllers\ReceitaController::class, 'create'])->name('private.cadastro_receita');

Route::post('/receita/cadastro', [\App\Http\Controllers\ReceitaController::class, 'store'])->name('cadastrar_receita')->middleware('autenticado');

Route::get('/receitas/usuario', [\App\Http\Controllers\ReceitaController::class, 'receitasUsuario'])->name('private.receitas');

Route::get('/receitas/favoritas', [\App\Http\Controllers\ReceitaController::class, 'receitasFavoritas'])->name('private.favoritas');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
