<?php

namespace App;

use App\Lib\WxPayApi;
use App\Lib\WxPayNotify;
use App\Lib\WxPayOrderQuery;
use Illuminate\Support\Facades\Session;

require_once "Lib/WxPay.Api.php";
require_once 'Lib/WxPay.Notify.php';

class PayNotifyCallBack extends WxPayNotify
{
    public function __construct()
    {
        $logHandler = new CLogFileHandler("Logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);
        Log::DEBUG("debut log");
    }

    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        Log::DEBUG("query:" . json_encode($result));
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS"
        ) {
            return true;
        }
        return false;
    }

    public function NotifyProcess($data, &$msg)
    {

        $jsonData = json_encode($data);
        Log::DEBUG("call back:" . $jsonData);
        $notfiyOutput = json_decode($jsonData, true);

        $booking_id = explode('#',$notfiyOutput['attach'])[0];
        $booking_name = explode('#',$notfiyOutput['attach'])[1];
        $booking_date = explode('#',$notfiyOutput['attach'])[2];

        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            $wechat = Wechat::create(
                [
                    'provider' => 'uv',
                    'booking' => $booking_id,
                    'status' => 'FAIL'
                ]
            );
            Log::DEBUG("save no transaction id");
            return false;
        }
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            $wechat = Wechat::create(
                [
                    'provider' => 'uv',
                    'booking' => $booking_id,
                    'status' => 'FAIL'
                ]
            );
            Log::DEBUG("save paymenet failed");
            return false;
        }

        $wechat = Wechat::create(
            [
                'provider' => 'uv',
                'booking' => $booking_id,
                'amount' => intval($notfiyOutput['total_fee']) / 100,
                'status' => $notfiyOutput['return_code'],
                'transaction_id' => $notfiyOutput['transaction_id'],
                'booking_name' => $booking_name,
                'booking_date' => $booking_date,
                'bank_type' => $notfiyOutput['bank_type'],
            ]
        );
        Log::DEBUG("save to database");
        return true;
    }
}

class CLogFileHandler implements ILogHandler
{
    private $handle = null;

    public function __construct($file = '')
    {
        $this->handle = fopen($file, 'a+');
    }

    public function write($msg)
    {
        fwrite($this->handle, $msg, 4096);
    }

    public function __destruct()
    {
        fclose($this->handle);
    }
}

interface ILogHandler
{
    public function write($msg);

}