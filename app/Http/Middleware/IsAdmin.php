<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }
        App::abort(404);
    }
}