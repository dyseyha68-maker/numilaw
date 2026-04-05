<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check URL query parameter first, then session, then browser preference
        $locale = $request->query('lang') 
            ?? Session::get('locale') 
            ?? $request->getPreferredLanguage(['en', 'km']);
        
        // Validate and set locale
        if (in_array($locale, ['en', 'km'])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            // Fallback to English
            App::setLocale('en');
            Session::put('locale', 'en');
        }
        
        return $next($request);
    }
}