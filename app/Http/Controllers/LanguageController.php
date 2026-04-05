<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch language
     */
    public function switch(Request $request, $locale)
    {
        $supportedLocales = config('app.supported_locales');
        
        if (!array_key_exists($locale, $supportedLocales)) {
            abort(404);
        }
        
        Session::put('locale', $locale);
        App::setLocale($locale);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'locale' => $locale,
                'language_name' => $locale === 'km' ? 'ភាសាខ្មែរ' : 'English'
            ]);
        }
        
        return redirect()->back();
    }
}