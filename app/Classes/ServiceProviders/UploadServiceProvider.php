<?php
namespace App\Classes\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Upload', 'App\Classes\Upload' );
    }
}