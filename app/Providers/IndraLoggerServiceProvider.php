<?php

namespace App\Providers;

use App\Helpers\IndraLogger;

use Illuminate\Support\ServiceProvider;

class IndraLoggerServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {

        $this->app->bind('IndraLogger', function () {

            return new IndraLogger();

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }

}
