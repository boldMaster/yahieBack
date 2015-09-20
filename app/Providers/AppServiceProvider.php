<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Sharing Global Variable to all the View
        $variable = array(
            'appName' => env('APP_NAME'),
            'cssPath' => env('APP_PUBLIC_CSS'),
            'jsPath' => env('APP_PUBLIC_JS'),
        );
        view()->share($variable);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
