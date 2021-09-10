<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::first();
        Auth::login($user);
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }
        abort(403, 'You have to be admin to delete the brand');
    }
}
