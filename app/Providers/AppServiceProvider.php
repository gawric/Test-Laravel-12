<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GuideService;
use App\Services\HuntingBooking;
use App\Services\Interface\GuideServiceInterface;
use App\Services\Interface\BookingServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GuideServiceInterface::class, GuideService::class);
        $this->app->singleton(BookingServiceInterface::class, HuntingBooking::class);
        
        $this->app->singleton(GuideRepository::class, function () {
            return new GuideRepository(new Guide());
        });
        $this->app->singleton(HuntingRepository::class, function () {
            return new HuntingRepository(new Hunting());
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
