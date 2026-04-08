<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share $lang with every Blade view so no view needs @php $lang = session(...)
        View::share('lang', session('lang', 'en'));

        // Re-share on every request (session changes after the provider boots)
        app('events')->listen('Illuminate\Foundation\Http\Events\RequestHandled', function () {
            View::share('lang', session('lang', 'en'));
        });

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
