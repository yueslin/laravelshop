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

//线上访问地址
function ngrok_url($routeName,$parameters=[])
{
    //开发配置，并且配置了 NGROK_URL
    if (app()->environment('local') && $url = config('app.ngrok_url')){
        //route() 函数第三个参数代表是否绝对路径
        return $url.route($routeName,$parameters,false);
    }

    return route($routeName,$parameters);
}
