<?php

namespace App\Http\Controllers;

use App\PayNotifyCallBack;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function NotifyWechat(Request $request)
    {
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);
        return redirect(url('/success'));
    }

    public function successWechat(Request $request)
    {
        return view('success');
    }

    public function errorWechat(Request $request)
    {
        return view('error');
    }
}