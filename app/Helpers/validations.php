<?php

if (!function_exists('isSetOrNull')) {
	function isSetOrNull($arr, $prop1 = null, $prop2 = null){
		if (!empty($arr) && is_null($prop1)){
			return $arr;
		}

		if (!empty($arr) && !is_null($prop1) && is_null($prop2)){
			return $arr->$prop1;
		}

        if (!empty($arr) && !is_null($prop1) && !is_null($prop2)){
			return $arr->$prop1->$prop2;
		}
		return null;
	}
}
