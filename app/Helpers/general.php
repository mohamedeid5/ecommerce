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

if(!function_exists('generateCategories')) {

    function generateCategories($categories) {

        foreach ($categories as $category) {

            echo '<li><a href="'. route("category", $category->slug) .'">'. $category->name . '<i class="fa fa-angle-right" aria-hidden="true"></i></a>';

            if($category->childs) {

               echo '<ul class="sub-category">';
                    echo '<li>';
                      generateCategories($category->childs);
                    echo '</li>';
                echo '</ul>';
            }

        }
    }

}
