<?php

namespace App\Http\Controllers;
use Endroid\QrCode\QrCode;
use App\Exceptions\InvalidRequestException;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\OrderPaid;

class PaymentController extends Controller
{
    protected function afterPaid(Order $order)
    {
        event(new OrderPaid($order));
    }

    public function payByAlipay(Order $order,Request $request)
    {
        $this->authorize('own',$order);

        if ($order->paid_at||$order->closed){
            throw new InvalidRequestException('订单状态不正确');
        }

        return app('alipay')->web([
            'out_trade_no' => $order->no, // 订单编号，需保证在商户端不重复
            'total_amount' => $order->total_amount, // 订单金额，单位元，支持小数点后两位
            'subject'      => '支付 Laravel Shop 的订单：'.$order->no, // 订单标题
        ]);
    }

    // 前端回调页面
    public function alipayReturn()
    {
        try{
            // 校验提交的参数是否合法
            $data = app('alipay')->verify();
        }catch(\Exception $e){
            return view('pages.error',['msg' => '数据不正确']);
        }

        return view('pages.success',['msg' => '付款成功']);
    }

    // 服务器端回调
    public function alipayNotify()
    {
        $data = app('alipay')->verify();
        if(!in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return app('alipay')->success();
        }

        $order = Order::where('no', $data->out_trade_no)->first();
        if (!$order){
            return 'fail';
        }

        if ($order->paid_at){
            return app('alipay')->success();
        }

        $order->update([
            'paid_at'        => Carbon::now(), // 支付时间
            'payment_method' => 'alipay', // 支付方式
            'payment_no'     => $data->trade_no, // 支付宝订单号
        ]);

        $this->afterPaid($order);

        return app('alipay')->success();

    }


    public function payByWechat(Order $order,Request $request)
    {
        $this->authorize('own', $order);
        if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }

        // 之前是直接返回，现在把返回值放到一个变量里
//        $wechatOrder = app('wechat_pay')->scan([
//            'out_trade_no' => $order->no,
//            'total_fee'    => $order->total_amount * 100,
//            'body'         => '支付 Laravel Shop 的订单：'.$order->no,
//        ]);
        // 把要转换的字符串作为 QrCode 的构造函数参数
        $qrCode = new QrCode('http://www.baidu.com');

        // 将生成的二维码图片数据以字符串形式输出，并带上相应的响应类型
//        return response($qrCode->writeString(), 200, ['Content-Type' => $qrCode->getContentType()]);
        return response($qrCode->writeString(), 200, ['Content-Type' => $qrCode->getContentType()]);
    }

    public function wechatNotify()
    {
        // 校验回调参数是否正确
        $data  = app('wechat_pay')->verify();
        // 找到对应的订单
        $order = Order::where('no', $data->out_trade_no)->first();
        // 订单不存在则告知微信支付
        if (!$order) {
            return 'fail';
        }
        // 订单已支付
        if ($order->paid_at) {
            // 告知微信支付此订单已处理
            return app('wechat_pay')->success();
        }

        // 将订单标记为已支付
        $order->update([
            'paid_at'        => Carbon::now(),
            'payment_method' => 'wechat',
            'payment_no'     => $data->transaction_id,
        ]);
        $this->afterPaid($order);

        return app('wechat_pay')->success();
    }

}
