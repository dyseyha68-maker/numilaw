<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
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
        // Custom translation helpers
        if (!function_exists('km_date')) {
            function km_date($date) {
                if ($date instanceof \Carbon\Carbon) {
                    return $date->format('d/m/Y');
                }
                return $date;
            }
        }

        if (!function_exists('km_number')) {
            function km_number($number) {
                return number_format($number, 0, '.', ',');
            }
        }

        if (!function_exists('km_currency')) {
            function km_currency($amount) {
                return '$' . number_format($amount, 2);
            }
        }

        if (!function_exists('get_degree_type_label')) {
            function get_degree_type_label($type) {
                $labels = [
                    'bachelor' => __('admission.bachelor_programs'),
                    'master' => __('admission.masters_programs'),
                    'doctorate' => __('admission.phd_programs_title'),
                    'certificate' => __('admission.certificate_programs_title'),
                ];
                return $labels[$type] ?? $type;
            }
        }
    }
}