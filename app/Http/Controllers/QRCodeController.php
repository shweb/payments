<?php

namespace App\Http\Controllers;

use App\Lib\WxPayConfig;
use App\Lib\WxPayUnifiedOrder;
use App\NativePay;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function qrCodeWechat(Request $req)
    {
//        dd($req->input('from'));
//        dd($req->input());
        $notify = new NativePay();
        if ($req->input('from') == 'uv') {
            $input = new WxPayUnifiedOrder();
            $input->SetBody("ULTRAVIOLET");
            $booking_id = $req->input('booking');
//            $_SESSION['booking_id'] = $booking_id;
            $input->SetAttach($booking_id);
            if ($req->input('amount')) {
                $amount = intval($_GET['amount']);
                $amount_vrai = 100 * $amount;
                $input->SetTotal_fee($amount_vrai);
//                $_SESSION['amount'] = $amount;
            } else
                $input->SetTotal_fee("1");
            $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
            $input->SetTime_start(date("YmdHis"));
//            $input->SetTime_expire(date("YmdHis", time() + 1200));
//            dd('time start : ' . date("YmdHis") . ' time end : ' . date("YmdHis", time() + 600));
            $input->SetGoods_tag("ULTRAVIOLET");
            $input->SetNotify_url("http://uvbypp-mmbund-payments.com/payments/wechat/notify");
//            "http://uvbypp-mmbund-payments.com/payments/wechat/notify"
            $input->SetTrade_type("NATIVE");
            $input->SetProduct_id("123456789");
            $result = $notify->GetPayUrl($input);
            $url2 = $result["code_url"];
            return view('qrcode')->with(compact('url2'));
        }
        return view('qrcode');
    }

    public function test()
    {
        return "test success";
    }
}
