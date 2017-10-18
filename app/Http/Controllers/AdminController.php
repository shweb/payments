<?php

namespace App\Http\Controllers;

use App\Wechat;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function wechat()
    {
        $payments = Wechat::get();
        return view('admin.story')->with(compact('payments'));
    }
}
