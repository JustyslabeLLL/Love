<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/authorization')->with('error', 'Пожалуйста, войдите в систему.');
        }

        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'У вас нет доступа к админ-панели.');
        }

        return $next($request);
    }
}
