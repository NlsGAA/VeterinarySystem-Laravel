<?php

namespace App\Providers;

use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use PatientsRepository;
use App\Services\PatientsServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PatientsRepositoryInterface::class,
            PatientsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
