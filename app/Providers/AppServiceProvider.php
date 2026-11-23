<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();

        // Share cart count with all views
        view()->composer('*', function ($view) {
            $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
            $view->with('globalCartCount', $cartCount);
        });
    }
}
