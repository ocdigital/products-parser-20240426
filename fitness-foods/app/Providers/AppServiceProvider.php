<?php

namespace App\Providers;

use App\Repositories\ImportHistoryRepository;
use App\Repositories\ImportHistoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

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
