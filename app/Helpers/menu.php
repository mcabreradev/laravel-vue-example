<?php

if (!function_exists('activeIfRouteIs')) {
	function activeIfRouteIs($pattern, $class='active')
    {
		return Request::is($pattern) ? $class : '';
	}
}
