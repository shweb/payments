<?php

namespace App\Http\Controllers;

use App\Lib\WxPayConfig;
use App\Lib\WxPayUnifiedOrder;
use App\NativePay;
use App\Wechat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QRCodeController extends Controller
{
    public function qrCodeWechat(Request $req)
    {

        $notify = new NativePay();
        if ($req->input('from') == 'uv') {
            $input = new WxPayUnifiedOrder();
            $input->SetBody("ULTRAVIOLET");
            $booking_id = $req->input('booking');
            Session::put('booking_id', $booking_id);
            $booking_name = $req->input('booking_name');
            $booking_date = $req->input('booking_date');
            $input->SetAttach($booking_id . '#' . $booking_name . '#' . $booking_date);
            $amount_vrai = 0;
            if ($req->input('amount')) {
                $amount = floatval($_GET['amount']);
                $amount_vrai = 100 * $amount;
                $input->SetTotal_fee($amount_vrai);
                Session::put('amount', $amount);
                if ($amount == 0) {
                    $amount_vrai = 1;
                    $input->SetTotal_fee("1");
                } else
                    $input->SetTotal_fee($amount_vrai);
            } else {
                $amount_vrai = 1;
                $input->SetTotal_fee("1");
            }
            $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
            $input->SetTime_start(date("YmdHis"));
            $input->SetGoods_tag("ULTRAVIOLET");
            $input->SetNotify_url("http://uvbypp-mmbund-payments.com/payments/wechat/notify");
            $input->SetTrade_type("NATIVE");
            $input->SetProduct_id("123456789");
            $result = $notify->GetPayUrl($input);
            $url2 = $result["code_url"];
            $wechat = new Wechat();
            $nombreActuelle = $wechat->count();
            return view('qrcode')->with(compact('url2', 'nombreActuelle', 'amount_vrai'));
        }
        return view('qrcode');
    }

    public function test()
    {
        return "test success";
    }
}
