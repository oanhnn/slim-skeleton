<?php

namespace App\Utility;

/**
 * An inflector
 */
class Inflector
{

    /**
     * @var array
     */
    protected static $cached = [];

    /**
     * Set/get cached value
     *
     * @param string $type
     * @param string $key
     * @param string $value
     * @return bool|string
     */
    protected static function cache($type, $key, $value = '')
    {
        if ($value !== false) {
            static::$cached[$type][$key] = $value;
            return $value;
        }
        if (!isset(static::$cached[$type][$key])) {
            return false;
        }
        return static::$cached[$type][$key];
    }

    /**
     * Camelize a string
     * Convert abc_xyz to abcXyz
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function camelize($string, $delimiter = '_')
    {
        return lcfirst(static::studlyCaps($string, $delimiter));
    }

    /**
     * Studly caps a string
     * Convert abc_xyz to AbcXyz
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function studlyCaps($string, $delimiter = '_')
    {
        $cacheType = __FUNCTION__ . $delimiter;
        $result = static::cache($cacheType, $string);

        if (false === $result) {
            $result = implode('', array_map('ucfirst', explode($delimiter, $string)));
            static::cache($cacheType, $string, $result);
        }

        return $result;
    }
}
