<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        //On force les strings a etre de max 191 caracteres pour éviter erreur encode utf8mb4 qui prend trop de place
        Schema::defaultStringLength(191);
    }
}
