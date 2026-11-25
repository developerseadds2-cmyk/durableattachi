<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('admin.login');
        }

        if (!Auth::user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->route('admin.login')->with('error', 'Access denied. Admin privileges required.');
        }

        if (!Auth::user()->status) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Your account has been disabled.');
        }

        return $next($request);
    }
}
