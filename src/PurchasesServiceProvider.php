<?php
namespace duncanrmorris\purchases;

use Illuminate\Support\ServiceProvider;

class PurchasesServiceProvider extends ServiceProvider

{
    
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','purchases');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        
    }

    public function register()
    {
        
    }
}

