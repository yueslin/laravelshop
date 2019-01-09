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

//默认的精度为小数点后两位
function big_number($number,$scale = 2)
{
    return new \Moontoast\Math\BigNumber($number,$scale);
}
