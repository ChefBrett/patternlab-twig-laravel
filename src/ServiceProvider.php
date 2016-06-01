<?php

namespace Daspete\Laravel;

use Illuminate\Support\ServiceProvider as ServiceProvider_Base;

class ServiceProvider extends ServiceProvider_Base {

    public function register(){

    }

    public function boot(){
        $this->loadConfiguration();
    }

    protected function isLumen(){
        return strpos($this->app->version(), 'Lumen') !== false;
    }

    protected function loadConfiguration(){
        $configPath = __DIR__ . '../config/patternlab.php';

        if(!$this->isLumen()){
            $this->publishes([ $configPath => config_path('patternlab.php') ], 'config');
        }

        $this->mergeConfigFrom($configPath, 'patternlab');
    }

}