<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Services\SiteSettingsService;
use Illuminate\Support\Facades\View;

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
    public function boot(SiteSettingsService $siteSettingsService)
    {
        Paginator::useBootstrap();
        $siteSettingsCache = $siteSettingsService->getSettings();
        View::share('siteSettings', $siteSettingsCache);
    }
}
