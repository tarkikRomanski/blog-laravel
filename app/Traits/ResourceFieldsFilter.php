<?php
/**
 * Created by PhpStorm.
 * User: vitaliyprokopov
 * Date: 7/21/18
 * Time: 3:30 PM
 */

namespace App\Traits;


trait ResourceFieldsFilter
{
    /**
     * @var array
     */
    protected static $withoutFields = [];

    /**
     * Set the keys that are supposed to be filtered out.
     * @param array $fields
     * @return self
     */
    public static function hide(array $fields)
    {
        self::$withoutFields = $fields;
        return self::class;
    }

    /**
     * Clear the filter keys array.
     * @return self
     */
    public static function clearHide() {
        self::$withoutFields = [];
        return self::class;
    }

    /**
     * Remove the filtered keys.
     * @param $array
     * @return array
     */
    protected function filterFields($array)
    {
        return collect($array)->forget(self::$withoutFields)->toArray();
    }
}