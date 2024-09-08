<?php

namespace App\Providers;

use App\Repositories\Contracts\PatientsRepositoryInterface;
use App\Repositories\Hospitalized\HospitalizedRepository;
use App\Repositories\Hospitalized\HospitalizedRepositoryInterface;
use App\Repositories\Owners\OwnersRepository;
use App\Repositories\Owners\OwnersRepositoryInterface;
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

        $this->app->bind(
            HospitalizedRepositoryInterface::class,
            HospitalizedRepository::class
        );

        $this->app->bind(
            OwnersRepositoryInterface::class,
            OwnersRepository::class
        );

        // $this->app->bind(PatientsServices::class, function ($app) {
        //     return new PatientsServices($app->make(PatientsRepositoryInterface::class), $app->make(HospitalizedRepositoryInterface::class));
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
