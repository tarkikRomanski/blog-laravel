<?php

namespace App\Classes\Facades;

use Illuminate\Support\Facades\Facade;

class StringToObject extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'StringToObject';
    }
}