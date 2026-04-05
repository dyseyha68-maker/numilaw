<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();    
        // Set default string length for older MySQL versions
        Schema::defaultStringLength(191);

        // Force SSL in production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Load flat translation files from resources/lang/en.php and km.php
        $this->loadFlatTranslations();
    }

    protected function loadFlatTranslations(): void
    {
        $langPath = resource_path('lang');
        
        foreach (['en', 'km'] as $locale) {
            $flatFile = $langPath . '/' . $locale . '.php';
            if (file_exists($flatFile)) {
                $translations = require $flatFile;
                if (is_array($translations)) {
                    $flattened = $this->flattenTranslations($translations);
                    app('translator')->addLines($flattened, $locale);
                }
            }
        }
    }

    protected function flattenTranslations(array $array, string $prefix = ''): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            $newKey = $prefix ? "{$prefix}.{$key}" : $key;
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenTranslations($value, $newKey));
            } else {
                $result[$newKey] = $value;
            }
        }
        return $result;
    }
}
