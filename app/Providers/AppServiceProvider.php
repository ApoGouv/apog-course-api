<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CourseServiceInterface;
use App\Services\CourseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CourseServiceInterface::class, CourseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
