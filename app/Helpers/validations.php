<?php

if (!function_exists('isSetOrNull')) {
    function isSetOrNull($var)
    {
        return (null !== $var) ? $var : null;
    }
}
