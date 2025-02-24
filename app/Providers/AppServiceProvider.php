<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Schema::defaultStringLength(191);
        Blade::directive('role', function ($roles) {
            return "<?php if(auth()->check() && in_array(auth()->user()->role->nom, $roles)): ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
