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

            if(! class_exists('CreateTransactionTable')) {
                $this->publishes([
                    __DIR__ . '../database/migrations/create_transactions_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_transactions_table.php'), 
                ], 'migrations');
            }
        }
    }
}