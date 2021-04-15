<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.app', 'landingLayouts.app'], function ($view) {
            $appVariables = [
                'env' => config('app.env'),
                'csrfToken' => csrf_token(),
                'user' => auth()->user(),
            ];

            $view->with('appVariables', $appVariables);
        });
    }
}
