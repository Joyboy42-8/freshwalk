<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Front\PanierController;
use App\Models\Commande;
use App\Models\Activity;
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
        View::composer('*', function ($view) {
            $view->with('panierCount', PanierController::totalItems());
        });
        View::composer('admin.base', function ($view) {
            $pendingCount = Commande::where('status', 'pending')->count();
            $view->with('pendingCount', $pendingCount);
        });
    }
}
