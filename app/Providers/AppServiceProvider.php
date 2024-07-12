<?php

namespace App\Providers;

use App\Repositories\Contracts\PatientsRepositoryInterface;
use App\Repositories\PatientsRepository;
use App\Services\PatientsServices;
use Illuminate\Support\ServiceProvider;

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

        $this->app->bind(PatientsServices::class, function ($app) {
            return new PatientsServices($app->make(PatientsRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
