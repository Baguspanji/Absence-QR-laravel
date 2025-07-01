<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register aliases from config/aliases.php if it exists
        if (file_exists(config_path('aliases.php'))) {
            $aliases = config('aliases', []);
            $loader = AliasLoader::getInstance();

            foreach ($aliases as $alias => $class) {
                $loader->alias($alias, $class);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
