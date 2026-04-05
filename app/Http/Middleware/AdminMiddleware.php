<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Debug current user role
        Log::info('Current user ID: ' . Auth::id());
        Log::info('Current user email: ' . Auth::user()->email);
        Log::info('Current user role: ' . Auth::user()->role);

        if (!Auth::user()->isAdmin()) {
            Log::error('User is not admin! Role: ' . Auth::user()->role);
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}