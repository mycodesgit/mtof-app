<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AppLogoFavicon;
use App\Models\AppName;

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
        // Share $settings with all views automatically
        View::composer('*', function ($view) {
            $view->with('settings', AppLogoFavicon::first());
            $view->with('appSetting', AppName::first());
        });
    }
}
