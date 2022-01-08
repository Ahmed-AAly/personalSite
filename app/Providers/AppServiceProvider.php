<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

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
        Paginator::useBootstrap();

        // this part is a work arround to a problem that is triggered
        // when caches are cleared, all users both visitors and site owner
        // wouldn't be able to take any action if the site setting caches were not defind.
        if (!Cache::has('siteSettings')) {
            Cache::rememberForever('siteSettings', function () {
                $siteSettingsCache = ['maintenancemode' => 'false'];
                return $siteSettingsCache;
            });
        }
    }
}
