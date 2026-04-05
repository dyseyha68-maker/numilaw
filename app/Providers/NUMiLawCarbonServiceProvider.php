<?php

use Illuminate\Support\ServiceProvider;

class NUMiLawCarbonServiceProvider extends ServiceProvider
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
        // Configure Carbon locales for date formatting
        $locales = [
            'km' => [
                'months' => [
                    'មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា',
                ],
                'months_short' => ['មករ', 'កុម្ភ', 'មីន', 'មេស', 'ឧសភ', 'មិថុន', 'កក្កដ', 'សីហ', 'កញ្ញ', 'តុល', 'វិច្ឆ', 
                ],
                'weekdays' => [
                    'ច័ន្ទ', 'អង្គោ', 'អង្គបអភ', '�ុធ', 'ព្រហស្បរិច្ឆ', 'សុក្រ', 'សៅរ',
                ],
                'weekdays_short' => ['ច័ន្ទ', 'អង្គ', 'អង្គប', 'ពុធ', 'ព្រហ', 'សុក', 'សៅរ'],
                'first_day_of_week' => 1, // Monday
                'day_of_first_week_of_year' => 1, // First Monday
            ]
        ];

        foreach ($locales as $locale => $config) {
            \Carbon\Carbon::setLocale($locale, $config);
        }
    }
}