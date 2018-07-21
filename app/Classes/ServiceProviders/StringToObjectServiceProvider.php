<?php
namespace App\Classes\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class StringToObjectServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('StringToObject', 'App\Classes\StringToObject' );
    }
}