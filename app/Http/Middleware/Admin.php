<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (auth()->user()->userTypes == 'admin') {
        //     return $next($request);
        // }
        /** @var App\Models\User */
        $user = Auth::user();
        if ($user->hasRole(['super-admin', 'admin'])) {
            return $next($request);
        }
        abort('403', 'Akses khusus Admin');
    }
}
