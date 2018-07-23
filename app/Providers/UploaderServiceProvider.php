<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UploaderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Uploader', 'App\Helpers\Uploader');
    }
}