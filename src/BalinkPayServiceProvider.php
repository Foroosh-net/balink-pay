<?php
namespace Balink\BalinkPay;

use Illuminate\Support\ServiceProvider;

class BalinkPayServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind('BalinkPay', function($app) {
            return new BalinkPay();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'balinkpay');
    }

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('balinkpay.php'),
            ], 'config');
        }
    }
}