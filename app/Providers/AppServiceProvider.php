<?php

namespace App\Providers;

use App\Models\RentalOrder;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
            $view->with('user', auth()->user());
        });

        Paginator::defaultView('pagination::default');

        Gate::define('destroy-rental-order', function (User $user, RentalOrder $rentalOrder) {
            return $user->is_admin;
        });
    }
}
