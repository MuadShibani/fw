<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share $lang with ALL views on every request.
        // This means no view ever needs @php $lang = session('lang', 'en') @endphp
        View::composer('*', function ($view) {
            $lang  = session('lang', 'en');
            $isRTL = $lang === 'ar';
            $view->with(compact('lang', 'isRTL'));
        });
    }
}
