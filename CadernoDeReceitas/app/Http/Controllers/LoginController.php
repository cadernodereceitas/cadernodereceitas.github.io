<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoReceita;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // use RegistersUsers;

    public function paginaLogin()
    {
        $tiposReceitas = TipoReceita::all();
        return view('public.login', ['tiposReceitas' => $tiposReceitas]);
        // return view('public.login');
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

        $tiposReceitas = TipoReceita::all();
        return redirect()->route('home', ['tiposReceitas' => $tiposReceitas]);
    }

    public function logout()
    {
        session_destroy();

        $tiposReceitas = TipoReceita::all();
        return redirect()->route('home', ['tiposReceitas' => $tiposReceitas]);
    }
}
