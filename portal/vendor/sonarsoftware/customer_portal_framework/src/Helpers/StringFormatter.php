<?php

namespace SonarSoftware\CustomerPortalFramework\Helpers;

class StringFormatter
{
    /**
     * Convert a string to camel case
     * @param $str
     * @return mixed
     */
    public static function camelCase($str) {
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $str);
    }
}