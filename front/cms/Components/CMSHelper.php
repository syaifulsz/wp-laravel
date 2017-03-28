<?php

namespace SSZ\CMS\Components;

use Illuminate\Support\Facades\Cache;

class CMSHelper
{
    /**
     * Generate a standart cache key from sting or arguments of array
     *
     * @param  mixed    $args       can be an array or string
     * @param  string   $prefix     optional prefix
     * @param  boolean  $explicit   return array of key and arguments
     * @return mixed
     */
    public static function cacheKeygen($args, $prefix = '', $explicit = false)
    {
        $key = $args;
        $key = is_array($key) ? http_build_query($key) : $key;
        $key = ($prefix ? "{$prefix}_" : '') . md5($key);

        return $explicit ? ['key' => $key, 'arguments' => $args] : $key;
    }

    /**
     * This function is made to create static cache with no expiry (cached
     * forever) from given validated data. When this function is called with
     * a exist cache key but with empty or invalid data, it will return the
     * static cache data.
     *
     * @param  mixed    $key            can be an array or string
     * @param  mixed    $data
     * @param  mixed    $checkEmpty     can be an anonymous function or bool
     * @return mixed
     */
    public static function staticCache($key, $data, $checkEmpty = false, $prefix = 'staticCache') {

        // $checkEmpty can be an anonymous function or a bool it self
        $checkEmpty = is_callable($checkEmpty) && is_bool($checkEmpty($data)) ? $checkEmpty($data) : $checkEmpty;

        $backupCache = [];
        if (!$key) return $backupCache;

        // added country code on as key prefix to avoid cache key conflict between country
        list($key, $errorKey) = self::cacheKeygen($key, $prefix, true);

        $backupCache = Cache::get($key);
        if ($data && $checkEmpty) {
            Cache::forever($key, $data);
            return $data;
        }

        // logging errors
        $error = __METHOD__ . " ::: KEY \"{$key}\", NO DATA";
        if ($backupCache) $error .= " --> USE BACKUP DATA \"{$key}\"";
        \Log::error($error . ' [[[]]] ' . print_r($errorKey, true));

        return $backupCache;
    }
}