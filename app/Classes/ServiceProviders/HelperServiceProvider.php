<?php

namespace App\Classes\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Helper', 'App\Classes\Helper');
    }
}