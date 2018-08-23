<?php

namespace App\Providers;
use View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use Orchestra\Support\Facades\Tenanti;
use App\Company;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $user = Auth::user();
        // print_r($user);
        // Tenanti::setupMultiDatabase('tenants', function (Company $entity, array $config) {
        //     $config['database'] = "cas_{$entity->getKey()}"; 
        //     // refer to config under `database.connections.tenants.*`.

        //     return $config;
        // });    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }
}
