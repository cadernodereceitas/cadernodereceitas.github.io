<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoUserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isset(auth()->user()->id) && auth()->user()->id != '' && (auth()->user()->userAdmin || auth()->user()->superUser))
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('public.login');
        }
    }
}
