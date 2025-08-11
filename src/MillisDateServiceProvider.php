<?php

namespace RakibHamid\MillisDate;

use Illuminate\Support\ServiceProvider;
use RakibHamid\MillisDate\Core\MillisDateManager;

class MillisDateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('millis-date', function () {
            return new MillisDateManager();
        });
    }

    public function boot(): void
    {

    }
}
