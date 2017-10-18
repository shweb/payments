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
        $w = $wechat->get()[0];
        return $w->booking . '|' . $w->status;
    }
}

?>