<?php

namespace App\Libraries;

use Carbon\Carbon;
use File;
use DateTime;
use App\Models\Load;

class Ultilities
{
    // Clear XSS
    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);
        return $string;
    }

    public static function removeScripts($str)
    {
        $regex =
            '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|' .
            '<script[^>]*>.*?<\/script>|' .
            '<style[^>]*>.*?<\/style>|' .
            '<!--.*?-->/is';
        return preg_replace($regex, '', $str);
    }

    public static function clearXssInput($input)
    {
        $data = array_map(function ($value) {
            return self::clearXSS($value);
        }, $input);
        return $data;
    }
}
