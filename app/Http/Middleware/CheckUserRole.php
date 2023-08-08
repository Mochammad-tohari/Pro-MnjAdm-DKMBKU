<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user's role matches the required role
        if ($user && $user->akses === $role) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
    }
}
