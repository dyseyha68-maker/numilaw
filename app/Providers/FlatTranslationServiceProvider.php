<?php

namespace App\Providers;

use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Translation\FileLoader;

class FlatTranslationServiceProvider extends TranslationServiceProvider
{
    public function register()
    {
        $this->app->singleton('translation.loader', function ($app) {
            $loader = new FileLoader($app['files'], $app['path.lang']);
            
            $langPath = resource_path('lang');
            
            if (is_dir($langPath)) {
                $additionalPaths = [];
                
                $files = glob($langPath . '/*.php');
                foreach ($files as $file) {
                    $locale = basename($file, '.php');
                    if (in_array($locale, ['en', 'km'])) {
                        $additionalPaths[] = $file;
                    }
                }
                
                $loader->addJsonPath($langPath);
            }
            
            return $loader;
        });
    }
}
