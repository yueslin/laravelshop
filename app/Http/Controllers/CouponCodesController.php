<?php

namespace App\Http\Controllers;

use App\Models\CouponCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\CouponCodeUnavailableException;

class CouponCodesController extends Controller
{
    public function show($code)
    {
        //判断优惠券是否存在
        if (!$record = CouponCode::query()->where('code', $code)->first()) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }
        
        //校检优惠券是否达到可用条件
        $record->checkAvailable();
        
        return $record;
       
    }
}



