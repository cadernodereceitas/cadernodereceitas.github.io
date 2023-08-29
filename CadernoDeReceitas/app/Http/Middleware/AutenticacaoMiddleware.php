<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // session_start();

        // if(isset($_SESSION['email']) && $_SESSION['email'] != '')
        // {
        //     return $next($request);
        // }
        // else
        // {
        //     return redirect()->route('public.login');
        // }
        // session_start();

        if(isset(auth()->user()->id) && auth()->user()->id != '')
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('public.login');
        }
    }
}
