<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }
        $role = strtolower($role);
        return redirect()->route("$role.login.index")->with('error', 'Anda tidak memiliki akses');
    }
}
