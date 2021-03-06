<?php

namespace App\Http\Controllers;


use App\Wechat;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function getPayement(Request $req)
    {
        $wechat = Wechat::where('booking', '=', $req->input('booking'))->get()->take(1);
        return $wechat[0]->amount . '|' . $wechat[0]->transaction_id . '|' . Carbon::parse($wechat[0]->created_at)->format('Y-m-d');
    }
}

?>