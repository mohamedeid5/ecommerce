<?php


define('PAGINATION_NUMBER', 7);


if (!function_exists('getFolder')) {
    $dir = '';
    function getFolder() {

        return app()->getLocale() == 'ar' ? $dir = 'css-rtl' : 'css';

    }

}

if (!function_exists('getFile')) {
    $dir = '';
    function getFile() {

        return app()->getLocale() == 'ar' ? $dir = 'css-rtl' : 'css';

    }

}
