<?php

namespace Hoeril\Lazop;

use Illuminate\Support\ServiceProvider;

class LazopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Hoeril\Lazop\Constants');
        $this->app->make('Hoeril\Lazop\LazopClient');
        $this->app->make('Hoeril\Lazop\LazopLogger');
        $this->app->make('Hoeril\Lazop\LazopRequest');
        $this->app->make('Hoeril\Lazop\UrlConstants');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
