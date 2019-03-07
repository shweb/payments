<?php

namespace App\Http\Controllers;
use App\Alipay;
use App\Lib\AlipayTradeService;
use App\Lib\AlipayTradePagePayContentBuilder;
use Illuminate\Http\Request;

Class AlipayController extends Controller
{

    public function alipayhome(){
        return view('alipayhome');
    }

    public function alipayqrcode(Request $request){
        $alipay_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQAB";
        $merchant_private_key = "MIIEowIBAAKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQABAoIBADq7KrJ2pEhQDiYeGqHhnsxoTxjmnUwroHy+EOQKID4K4w3M6Nmv6GSZU5aehgoV7Hf8MMCDlw5SmqTnB5FdEpnMT2ffyjoqOKkTTxBkIR0QxbUsZjtZWq05MFX11ascWHY5gc/mgnzjI5zPqjJccCXQFtqrwUSkceYkqXGjxr5H+9YBZs1al7lt02EO0+59aXo5CkcZnbCRu7j1j8ADx+c4iFe41UmzEAXgotuhCnR66Omgbv9NndW1jC5VmAc1kVPuLFJAlu2I7y2b2NGPIe1rhUXH58hXwsW5DF8TCUKIO35EYOcJuRvVV5IZoaICBvERtYFDLMQTeLK0tY278aECgYEA4S8glEeBR2gw5Zpn71WHCSnehe3wrD/OwtCg8glysyr3Eo8tAhNIyQfb/W1il30s76YK1401rJ4LzWBDKnS8/FF8PXFxlMjD+gkC0Mc40lmuA+Ejz2AtjRZY2qfzC3Mo0wRQfK3spzj5JSozuZXoXsF14u/sg2gKw0cW7BcSkisCgYEA0vFX7OIN2rxc25ar4fb0f5zk3GhrUPvGlwDu77ZKPFkJnWmrgPAzlQBvQuZB5ltO0dNjYyXkDJZRZinTd0IdPS/sro3K8TXa+bG4LJB5MHVSoIoyeKpwVgEVDm3mrMb8ChjwRGxs7hhgApXEX9sDyoBFrADyPaIknot+RMBn0vMCgYANt2ksnw5o4xfXZIhgM719+WbskYnPdDOL+llTZO/vqfZS0xXSwon0dN4ZmcgfoihSkLKoXpmeYiIl6G8u7t10ISKIO5jHj1Mgr9vUC86SQZQv+E7OGvWrWmkfKIvNbr5V3DVq4s0/gmDqup9b9p2o5+/eWu71Mik1q+bhiqY+8QKBgQDBmBPc6J5UeHk0YvS+vnooQGLeUcrkGR5qacXgJEm/Vuv3Fwr6m/iLMEnseQxUEMqm0b2uOhEw6CgufgaAtiHFjR1IGgP+GjIs5UklRTakHZjGk+68RZgxpm6fvodtXHXmAntIIMZcQeyjkrYWTxgMmmrW8Eth+1RmWZl6GadvtwKBgHM67cLSFZUB+PJUnSsDsXQ0T5UaF9PWlm9NkVZcD1Mb3u5A3T6sGVCG5QrSnMYgFMexD1yWmhIf72Gm0SvPdjfkcVuq7L/X+QVIlsux99sSMUKym55XhUTTE99tEWxyhtguyO/JcqRDIgNhF3W93vQdXl+H+xtKIZWF70Y+h0uy";
        $config = array (
            'app_id' => "2019010862858609",
            'merchant_private_key' => $merchant_private_key,
            'notify_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/notify",
            'return_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/return",
            'charset' => "UTF-8",
            'sign_type'=>"RSA2",
            'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
            'alipay_public_key' => $alipay_public_key,
        );
        $out_trade_no = trim($request->get('WIDout_trade_no'));
        $subject = trim($request->get('WIDsubject'));
        $total_amount = trim($request->get('WIDtotal_amount'));
        $body = trim($request->get('WIDbody'));

        $payRequestBuilder = new AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $aop = new AlipayTradeService($config);
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        var_dump($response);


    }
    public function return_url(Request $request){
        $alipay_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQAB";
        $merchant_private_key = "MIIEowIBAAKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQABAoIBADq7KrJ2pEhQDiYeGqHhnsxoTxjmnUwroHy+EOQKID4K4w3M6Nmv6GSZU5aehgoV7Hf8MMCDlw5SmqTnB5FdEpnMT2ffyjoqOKkTTxBkIR0QxbUsZjtZWq05MFX11ascWHY5gc/mgnzjI5zPqjJccCXQFtqrwUSkceYkqXGjxr5H+9YBZs1al7lt02EO0+59aXo5CkcZnbCRu7j1j8ADx+c4iFe41UmzEAXgotuhCnR66Omgbv9NndW1jC5VmAc1kVPuLFJAlu2I7y2b2NGPIe1rhUXH58hXwsW5DF8TCUKIO35EYOcJuRvVV5IZoaICBvERtYFDLMQTeLK0tY278aECgYEA4S8glEeBR2gw5Zpn71WHCSnehe3wrD/OwtCg8glysyr3Eo8tAhNIyQfb/W1il30s76YK1401rJ4LzWBDKnS8/FF8PXFxlMjD+gkC0Mc40lmuA+Ejz2AtjRZY2qfzC3Mo0wRQfK3spzj5JSozuZXoXsF14u/sg2gKw0cW7BcSkisCgYEA0vFX7OIN2rxc25ar4fb0f5zk3GhrUPvGlwDu77ZKPFkJnWmrgPAzlQBvQuZB5ltO0dNjYyXkDJZRZinTd0IdPS/sro3K8TXa+bG4LJB5MHVSoIoyeKpwVgEVDm3mrMb8ChjwRGxs7hhgApXEX9sDyoBFrADyPaIknot+RMBn0vMCgYANt2ksnw5o4xfXZIhgM719+WbskYnPdDOL+llTZO/vqfZS0xXSwon0dN4ZmcgfoihSkLKoXpmeYiIl6G8u7t10ISKIO5jHj1Mgr9vUC86SQZQv+E7OGvWrWmkfKIvNbr5V3DVq4s0/gmDqup9b9p2o5+/eWu71Mik1q+bhiqY+8QKBgQDBmBPc6J5UeHk0YvS+vnooQGLeUcrkGR5qacXgJEm/Vuv3Fwr6m/iLMEnseQxUEMqm0b2uOhEw6CgufgaAtiHFjR1IGgP+GjIs5UklRTakHZjGk+68RZgxpm6fvodtXHXmAntIIMZcQeyjkrYWTxgMmmrW8Eth+1RmWZl6GadvtwKBgHM67cLSFZUB+PJUnSsDsXQ0T5UaF9PWlm9NkVZcD1Mb3u5A3T6sGVCG5QrSnMYgFMexD1yWmhIf72Gm0SvPdjfkcVuq7L/X+QVIlsux99sSMUKym55XhUTTE99tEWxyhtguyO/JcqRDIgNhF3W93vQdXl+H+xtKIZWF70Y+h0uy";
        $config = array (
            'app_id' => "2019010862858609",
            'merchant_private_key' => $merchant_private_key,
            'notify_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/notify",
            'return_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/return",
            'charset' => "UTF-8",
            'sign_type'=>"RSA2",
            'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
            'alipay_public_key' => $alipay_public_key,
        );
        echo "subject=".$request->get('subject')."/////total amount=".$request->get('total_amount')."//////trade_no=".$request->get('trade_no')."//////out_trade_no".$request->get('out_trade_no')."////seller_id=".$request->get('seller_id');
        echo "\n eto";
        $arr=$_GET;
        $alipaySevice = new AlipayTradeService($config);
        $result = $alipaySevice->check($arr);
        var_dump($_GET);
        var_dump($arr);
        var_dump($result) ;
        //echo $arr["test1"] ;
        /*enregistrer base*/
        /*$alipay=Alipay::create([
            'provider' => 'uv',
            'booking' => 1, //mbola ts aiko hoe ina
            'total_amount' => $request->get('total_amount'),
            'out_trade_no' => $request->get('trade_no'),
            'trade_no' => $request->get('trade_no'),
            'seller_id' => $request->get('seller_id'),
            'status' => 'SUCCESS',
        ]);*/

        /*enregistrer base*/


        exit();
        if($result) {
            $out_trade_no = htmlspecialchars($request->get('out_trade_no'));
            $trade_no = htmlspecialchars($request->get('trade_no'));
            echo "Vérification réussie<br />Numéro de transaction Alipay：".$trade_no;
        }
        else {
            echo "La vérification a échoué";
        }
    }
    public function test_view(){
        return view('test');
    }
    public function test_return(Request $request){
        $alipay_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQAB";
        $merchant_private_key = "MIIEowIBAAKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQABAoIBADq7KrJ2pEhQDiYeGqHhnsxoTxjmnUwroHy+EOQKID4K4w3M6Nmv6GSZU5aehgoV7Hf8MMCDlw5SmqTnB5FdEpnMT2ffyjoqOKkTTxBkIR0QxbUsZjtZWq05MFX11ascWHY5gc/mgnzjI5zPqjJccCXQFtqrwUSkceYkqXGjxr5H+9YBZs1al7lt02EO0+59aXo5CkcZnbCRu7j1j8ADx+c4iFe41UmzEAXgotuhCnR66Omgbv9NndW1jC5VmAc1kVPuLFJAlu2I7y2b2NGPIe1rhUXH58hXwsW5DF8TCUKIO35EYOcJuRvVV5IZoaICBvERtYFDLMQTeLK0tY278aECgYEA4S8glEeBR2gw5Zpn71WHCSnehe3wrD/OwtCg8glysyr3Eo8tAhNIyQfb/W1il30s76YK1401rJ4LzWBDKnS8/FF8PXFxlMjD+gkC0Mc40lmuA+Ejz2AtjRZY2qfzC3Mo0wRQfK3spzj5JSozuZXoXsF14u/sg2gKw0cW7BcSkisCgYEA0vFX7OIN2rxc25ar4fb0f5zk3GhrUPvGlwDu77ZKPFkJnWmrgPAzlQBvQuZB5ltO0dNjYyXkDJZRZinTd0IdPS/sro3K8TXa+bG4LJB5MHVSoIoyeKpwVgEVDm3mrMb8ChjwRGxs7hhgApXEX9sDyoBFrADyPaIknot+RMBn0vMCgYANt2ksnw5o4xfXZIhgM719+WbskYnPdDOL+llTZO/vqfZS0xXSwon0dN4ZmcgfoihSkLKoXpmeYiIl6G8u7t10ISKIO5jHj1Mgr9vUC86SQZQv+E7OGvWrWmkfKIvNbr5V3DVq4s0/gmDqup9b9p2o5+/eWu71Mik1q+bhiqY+8QKBgQDBmBPc6J5UeHk0YvS+vnooQGLeUcrkGR5qacXgJEm/Vuv3Fwr6m/iLMEnseQxUEMqm0b2uOhEw6CgufgaAtiHFjR1IGgP+GjIs5UklRTakHZjGk+68RZgxpm6fvodtXHXmAntIIMZcQeyjkrYWTxgMmmrW8Eth+1RmWZl6GadvtwKBgHM67cLSFZUB+PJUnSsDsXQ0T5UaF9PWlm9NkVZcD1Mb3u5A3T6sGVCG5QrSnMYgFMexD1yWmhIf72Gm0SvPdjfkcVuq7L/X+QVIlsux99sSMUKym55XhUTTE99tEWxyhtguyO/JcqRDIgNhF3W93vQdXl+H+xtKIZWF70Y+h0uy";
        $config = array (
            'app_id' => "2019010862858609",
            'merchant_private_key' => $merchant_private_key,
            'notify_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/notify",
            'return_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/return",
            'charset' => "UTF-8",
            'sign_type'=>"RSA2",
            'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
            'alipay_public_key' => $alipay_public_key,
        );

        $arr=$_GET;

        $alipaySevice = new AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        var_dump($result) ;
        //echo $arr["test1"] ;
        exit();
        if($result) {
            $out_trade_no = htmlspecialchars($request->get('out_trade_no'));
            $trade_no = htmlspecialchars($request->get('trade_no'));
            echo "Vérification réussie.Numéro de transaction Alipay：".$trade_no;
        }
        else {
            echo "La vérification a échoué";
        }
    }
    public function notify_url(Request $request){
        $alipay_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQAB";
        $merchant_private_key = "MIIEowIBAAKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQABAoIBADq7KrJ2pEhQDiYeGqHhnsxoTxjmnUwroHy+EOQKID4K4w3M6Nmv6GSZU5aehgoV7Hf8MMCDlw5SmqTnB5FdEpnMT2ffyjoqOKkTTxBkIR0QxbUsZjtZWq05MFX11ascWHY5gc/mgnzjI5zPqjJccCXQFtqrwUSkceYkqXGjxr5H+9YBZs1al7lt02EO0+59aXo5CkcZnbCRu7j1j8ADx+c4iFe41UmzEAXgotuhCnR66Omgbv9NndW1jC5VmAc1kVPuLFJAlu2I7y2b2NGPIe1rhUXH58hXwsW5DF8TCUKIO35EYOcJuRvVV5IZoaICBvERtYFDLMQTeLK0tY278aECgYEA4S8glEeBR2gw5Zpn71WHCSnehe3wrD/OwtCg8glysyr3Eo8tAhNIyQfb/W1il30s76YK1401rJ4LzWBDKnS8/FF8PXFxlMjD+gkC0Mc40lmuA+Ejz2AtjRZY2qfzC3Mo0wRQfK3spzj5JSozuZXoXsF14u/sg2gKw0cW7BcSkisCgYEA0vFX7OIN2rxc25ar4fb0f5zk3GhrUPvGlwDu77ZKPFkJnWmrgPAzlQBvQuZB5ltO0dNjYyXkDJZRZinTd0IdPS/sro3K8TXa+bG4LJB5MHVSoIoyeKpwVgEVDm3mrMb8ChjwRGxs7hhgApXEX9sDyoBFrADyPaIknot+RMBn0vMCgYANt2ksnw5o4xfXZIhgM719+WbskYnPdDOL+llTZO/vqfZS0xXSwon0dN4ZmcgfoihSkLKoXpmeYiIl6G8u7t10ISKIO5jHj1Mgr9vUC86SQZQv+E7OGvWrWmkfKIvNbr5V3DVq4s0/gmDqup9b9p2o5+/eWu71Mik1q+bhiqY+8QKBgQDBmBPc6J5UeHk0YvS+vnooQGLeUcrkGR5qacXgJEm/Vuv3Fwr6m/iLMEnseQxUEMqm0b2uOhEw6CgufgaAtiHFjR1IGgP+GjIs5UklRTakHZjGk+68RZgxpm6fvodtXHXmAntIIMZcQeyjkrYWTxgMmmrW8Eth+1RmWZl6GadvtwKBgHM67cLSFZUB+PJUnSsDsXQ0T5UaF9PWlm9NkVZcD1Mb3u5A3T6sGVCG5QrSnMYgFMexD1yWmhIf72Gm0SvPdjfkcVuq7L/X+QVIlsux99sSMUKym55XhUTTE99tEWxyhtguyO/JcqRDIgNhF3W93vQdXl+H+xtKIZWF70Y+h0uy";
        $config = array (
            'app_id' => "2019010862858609",
            'merchant_private_key' => $merchant_private_key,
            'notify_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/notify",
            'return_url' => "http://uvbypp-mmbund-payments.com/payments/alipay/return",
            'charset' => "UTF-8",
            'sign_type'=>"RSA2",
            'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
            'alipay_public_key' => $alipay_public_key,
        );
        $arr=$_POST;
        $alipaySevice = new AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);
        if($result) {
            $out_trade_no = $request->get('out_trade_no');
            $trade_no = $request->get('trade_no');
            $trade_status = $request->get('trade_status');
            if($request->get('trade_status') == 'TRADE_FINISHED') {
            }
            else if ($request->get('trade_status') == 'TRADE_SUCCESS') {

            }
            //ajout anaty base
            $alipay=Alipay::create([
                'provider' => 'uv',
                'booking' => 1, //mbola ts aiko hoe ina
                'total_amount' => $request->get('total_amount'),
                'out_trade_no' => $request->get('trade_no'),
                'trade_no' => $request->get('trade_no'),
                'seller_id' => $request->get('seller_id'),
                'status' => 'SUCCESS',
            ]);
            echo "success";
        }
        else {
            //ajout anaty base
            $alipay=Alipay::create([
                'provider' => 'uv',
                'booking' => 1, //mbola ts aiko hoe ina
                'total_amount' => $request->get('total_amount'),
                'out_trade_no' => $request->get('trade_no'),
                'trade_no' => $request->get('trade_no'),
                'seller_id' => $request->get('seller_id'),
                'status' => 'FAILED',
            ]);
            echo "fail";
        }
    }
}

?>