<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once(glob(app_path().'/Helpers/helpers.php')[0]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::preventLazyLoading(! app()->isProduction());
    }
}
