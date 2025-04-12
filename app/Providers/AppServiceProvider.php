<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use App\admin\Repository\CategoryRepository;
use App\admin\Repository\CategoryRepositoryInterface;
use App\Models\Setting;

use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    Schema::defaultStringLength(191);
    try {
        if (Schema::hasTable('settings')) {
            $settings = Setting::all()->pluck('value', 'key');
            View::share('settings', $settings);
        }
    } catch (\Exception $e) {
        // Handle the exception, log it or display an error message
        FacadesLog::error('Error fetching settings: ' . $e->getMessage());
    }
}
}
