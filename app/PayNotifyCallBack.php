<?php

namespace App;

use App\Lib\WxPayApi;
use App\Lib\WxPayNotify;
use App\Lib\WxPayOrderQuery;
use App\Log;

require_once "Lib/WxPay.Api.php";
require_once 'Lib/WxPay.Notify.php';

class PayNotifyCallBack extends WxPayNotify
{
    public function __construct()
    {
        $logHandler = new CLogFileHandler("Logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);
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

        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }
        return true;
    }
}