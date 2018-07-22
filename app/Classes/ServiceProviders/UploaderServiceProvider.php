<?php
namespace App\Classes\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class UploaderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Upload', 'App\Classes\Uploader');
    }
}