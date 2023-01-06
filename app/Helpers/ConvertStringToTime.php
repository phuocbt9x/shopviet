<?php
if (!function_exists('convertStrToTime')) {
    function convertStrToTime($str)
    {
        $arrStr = explode('/', $str);
        return $arrStr[2] . '-' . $arrStr[1] . '-' . $arrStr[0];
    }
}
