<?php

namespace App\Http\Controllers;


use App\Wechat;

Class WechatController extends Controller
{
    public function getNombre()
    {
        $wechat = new Wechat();
        return $wechat->count();
    }

    public function getLastPayment()
    {
        $wechat = Wechat::orderby('id', 'desc')->take(1);
        $ok = false;
        count($wechat->get()) == 0 ? $ok = false : $ok = true;
        if ($ok)
            return $wechat->get()[0]->booking . '|' . $wechat->get()[0]->status;
        else
            return "0|FAIL";
    }
}

?>