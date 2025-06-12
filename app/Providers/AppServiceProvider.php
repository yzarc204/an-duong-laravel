<?php

namespace App\Providers;

use App\Models\GlucoseRecord;
use App\Observers\GlucoseRecordObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        GlucoseRecord::observe(GlucoseRecordObserver::class);
    }
}
