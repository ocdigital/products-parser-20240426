<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ImportHistoryRepository;
use App\Repositories\ImportHistoryRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImportHistoryRepositoryInterface::class, ImportHistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
