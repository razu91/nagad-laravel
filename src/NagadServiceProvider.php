<?php

namespace Razu\Nagad;

/**
 * Service Provider class
 * @author Razu <shahnaouzrazu21@gmail.com>
 */

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class NagadServiceProvider extends ServiceProvider
{

    /**
   * Bootstrap any application services.
   *
   * @return void
   */

    public function boot()
    {
        $this->publishes([
        __DIR__ . '/../config/nagad.php' => config_path('nagad.php'),
      ], 'config');

     AliasLoader::getInstance()->alias('NagadPaymentGateway', 'Razu\Nagad\Facades\Nagad');
    }

    public function register()
    {
        $this->app->bind('nagad',function(){
            return new Nagad;
        });
    }

}
