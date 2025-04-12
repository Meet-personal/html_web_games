<?php

namespace App\Providers;
use App\admin\Repository\CountryRepositoryInterface;
use App\admin\Repository\CountryRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
