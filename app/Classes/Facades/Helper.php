<?php

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class Helper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Helper';
    }
}