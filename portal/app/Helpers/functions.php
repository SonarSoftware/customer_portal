<?php

use Illuminate\Support\Facades\Session;

/**
 * Get the user object from the session
 * @return mixed|null
 */
function get_user()
{
    if (!Session::has("user"))
    {
        return null;
    }

    return Session::get("user");
}

/**
 * Convert bytes to gigabytes
 * @param $value
 * @return string
 */
function bytes_to_gigabytes($value)
{
    return round($value/1000**4,2) . "GB";
}