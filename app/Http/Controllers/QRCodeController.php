<?php

namespace App\Http\Controllers;

use App\Lib\WxPayConfig;
use App\Lib\WxPayUnifiedOrder;
use App\NativePay;
use App\Wechat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Lib\AlipaySubmit;


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

    /*alipay*/
    public function qrcodeAlipay(Request $req){
        $alipay_config['partner'] = '2088621891276675';
        $alipay_config['key'] = '6cgz2arb7djrp0ohrcz580a4sl1n0pfz';
        $alipay_config['notify_url'] = "http://商户网址/create_forex_trade-PHP-UTF-8-MD5-new/notify_url.php";
        $alipay_config['return_url'] = "http://www.alipay.com";
        $alipay_config['sign_type'] = strtoupper('MD5');
        $alipay_config['input_charset'] = strtolower('utf-8');
        $alipay_config['cacert'] = getcwd().'\\cacert.pem';
        $alipay_config['transport'] = 'https';
        $alipay_config['service'] = "create_forex_trade";
        $out_trade_no = $req->input('WIDout_trade_no');
        $subject = $req->input('WIDsubject');
        $currency = $req->input('currency');
        $total_fee = $req->input('WIDtotal_fee');
        $body = $req->input('WIDbody');
        $product_code = $req->input('WIDproduct_code');
        $split_fund_info = $req->input('WIDsplit_fund_info');
        $parameter = array(
            "service"       => $alipay_config['service'],
            "partner"       => $alipay_config['partner'],
            "notify_url"	=> $alipay_config['notify_url'],
            "return_url"	=> $alipay_config['return_url'],

            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "body"	=> $body,
            "currency" => $currency,
            "product_code" => $product_code,
            $split_fund_info => str_replace("\"", "'",'split_fund_info'),
            "split_fund_info"=>$split_fund_info,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "OK");
        echo $html_text;

        //return view('reponse_alipay');
    }
    public function index_alipay(){
        return view('index-alipay');
    }
    /*alipay*/

    public function test()
    {
        return "test success";
    }
}
