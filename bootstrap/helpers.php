<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 2018/12/3
 * Time: 16:26
 */

function route_class()
{
    return str_replace('.','-',Route::currentRouteName());
}