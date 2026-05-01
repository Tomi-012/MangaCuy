<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Share settings with all views
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::all()->pluck('value', 'key_name')->toArray();
                view()->share('site_settings', $settings);

                // Override config if needed
                if (isset($settings['site_name'])) {
                    config(['app.name' => $settings['site_name']]);
                }
            }
        } catch (\Exception $e) {
            // Silence errors during migrations/setup
        }
    }
}
