<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AddTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Session::has('_access_token')) {
            return redirect(url('/'));
        } else {
            $request->headers->set('Authorization', 'Bearer ' . Session::get('_access_token'));
            return $next($request);
        }
    }
}
