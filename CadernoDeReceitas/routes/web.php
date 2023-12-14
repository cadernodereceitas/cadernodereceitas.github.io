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

Route::get('/receita/detalhes/{receita}', [\App\Http\Controllers\ReceitaController::class, 'show'])->name('public.receita');

Route::get('/receita/cadastro', [\App\Http\Controllers\ReceitaController::class, 'create'])->name('private.cadastro_receita');

#--------------------------Rotas privadas

Route::middleware('autenticado')->prefix('/admin')->group(function() {

    Route::post('/receita/cadastro', [\App\Http\Controllers\ReceitaController::class, 'store'])->name('cadastrar_receita');

    Route::get('/receitas/usuario', [\App\Http\Controllers\ReceitaController::class, 'receitasUsuario'])->name('private.receitas');

    Route::get('/editar/receita/{receita}', [\App\Http\Controllers\ReceitaController::class, 'edit'])->name('private.receita');
    
    Route::post('/editar/receita/{receita}', [\App\Http\Controllers\ReceitaController::class, 'update'])->name('private.receita');

    Route::get('/rejeitar_receita/{receita}', [\App\Http\Controllers\ReceitaController::class, 'destroy'])->name('private.delete_receita');

    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    Route::get('/receitas/favoritas', [\App\Http\Controllers\FavoritoController::class, 'index'])->name('private.favoritas');

    Route::get('/receitas/favoritar/{receita}', [\App\Http\Controllers\FavoritoController::class, 'store'])->name('private.favoritar');

    Route::get('/receitas/desfavoritar/{receita}', [\App\Http\Controllers\FavoritoController::class, 'destroy'])->name('private.desfavoritar');

    Route::get('/receita/avaliar/{receita}/{valor}', [\App\Http\Controllers\AvaliacaoReceitaController::class, 'store'])->name('private.avaliar');
});

Route::middleware('autenticado_userAdmin')->prefix('/userAdmin')->group(function() {

    # Controle de tipos de receita
    Route::get('/tipo_de_receita/listar', [\App\Http\Controllers\TipoReceitaController::class, 'index'])->name('private.lista_tipoReceita');

    Route::get('/tipo_de_receita/cadastrar', [\App\Http\Controllers\TipoReceitaController::class, 'create'])->name('private.tipoReceita');

    Route::post('/tipo_de_receita/cadastrar', [\App\Http\Controllers\TipoReceitaController::class, 'store'])->name('private.tipoReceita');

    Route::get('/tipo_de_receita/editar/{tipoReceita}', [\App\Http\Controllers\TipoReceitaController::class, 'show'])->name('private.edit_tipoReceita');

    Route::post('/tipo_de_receita/editar/{tipoReceita}', [\App\Http\Controllers\TipoReceitaController::class, 'update'])->name('private.edit_tipoReceita');

    Route::get('/analisar_receita/listar', [\App\Http\Controllers\ReceitaController::class, 'avaliarReceitas'])->name('private.lista_analisar_receita');

    Route::get('/analisar_receita/{receita}', [\App\Http\Controllers\ReceitaController::class, 'aprovarReceita'])->name('private.aprovar_receita');
});

Route::middleware('autenticado_superUser')->prefix('/superUser')->group(function() {
    Route::get('/users/listar', [\App\Http\Controllers\LoginController::class, 'listar_usuarios'])->name('private.lista_usuarios');

    Route::get('/users/promover_useradmin/{user}', [\App\Http\Controllers\LoginController::class, 'promover_userAdmin'])->name('private.promover_userAdmin');

    Route::get('/users/rebaixar_useradmin/{user}', [\App\Http\Controllers\LoginController::class, 'rebaixar_userAdmin'])->name('private.rebaixar_userAdmin');

    Route::get('/users/promover_superuser/{user}', [\App\Http\Controllers\LoginController::class, 'promover_superUser'])->name('private.promover_superUser');
});
