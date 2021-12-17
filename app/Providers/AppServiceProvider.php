<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('convert', function ($money) {
            return "€ <?php echo number_format($money / 100, 2, ',', '.' ); ?>";
        });

        Blade::if('isRole', function ($role) {
            return Auth::check() && Auth::user()->getRole()->name === $role;
        });
    }
}
