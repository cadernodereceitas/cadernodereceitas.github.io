<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoReceita;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    // use RegistersUsers;

    public function paginaLogin()
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return view('public.login', ['tiposReceitas' => $tiposReceitas]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    public function autenticar(Request $request)
    {
        $user = new User();
        $rules = $user->rulesLogin();
        $feedback = $user->feedback();

        $request->validate($rules, $feedback);

        $email = $request->get('email');
        $password = $request->get('password');

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name))
        {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            

            if($usuario->userAdmin)
            {
                $_SESSION['autorizacao'] = 'userAdmin';
            }

            if($usuario->superUser)
            {
                $_SESSION['autorizacao'] = 'superUser';
            }
            
            // dd($_SESSION);
        }

        return redirect()->route('home');
    }

    public function registrar(Request $request)
    {
        $user = new User();
        $rules = $user->rulesRegister();
        $feedback = $user->feedback();

        $request->validate($rules, $feedback);

        User::create($request->all());

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return redirect()->route('home', ['tiposReceitas' => $tiposReceitas]);
    }

    public function logout()
    {
        session_destroy();

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        return redirect()->route('home', ['tiposReceitas' => $tiposReceitas]);
    }

    public function listar_usuarios()
    {
        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        $users = User::where('superUser', '!=', 1)->get();

        return view('private.lista_usuarios', ['tiposReceitas' => $tiposReceitas, 'users' => $users]);
    }

    public function promover_userAdmin(User $user)
    {
        $user->update(['userAdmin' => true]);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        $users = User::where('superUser', '!=', 1)->get();

        return redirect()->route('private.lista_usuarios', ['tiposReceitas' => $tiposReceitas, 'users' => $users]);
    }

    public function rebaixar_userAdmin(User $user)
    {
        $user->update(['userAdmin' => false]);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        $users = User::where('superUser', '!=', 1)->get();

        return redirect()->route('private.lista_usuarios', ['tiposReceitas' => $tiposReceitas, 'users' => $users]);
    }

    public function promover_superUser(User $user)
    {
        $user->update(['superUser' => true]);

        $tiposReceitas = Cache::remember('tipo_receita', 300, function() {
            return TipoReceita::all();
        });

        $users = User::where('superUser', '!=', 1)->get();

        return redirect()->route('private.lista_usuarios', ['tiposReceitas' => $tiposReceitas, 'users' => $users]);
    }
}
