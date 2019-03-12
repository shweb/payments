<?php

namespace App\Http\Controllers;

use App\Wechat;
use App\Alipay;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function wechat()
    {
        $payments = Wechat::get();
        return view('admin.story')->with(compact('payments'));
    }
    public function alipay()
    {
        $payments = Alipay::get();
        return view('admin.storyalipay')->with(compact('payments'));
    }



    public function trie_date(Request $req){
        $title=$req->input('title');
        $date_debut=$req->input('debut');
        $date_fin=$req->input('fin');
        if(strcmp($title,"payment")==0){
            $title="created_at";
        }
        elseif (strcmp($title,"booking")==0){
            $title="booking_date";
        }

        if(!empty($date_debut)&& !empty($date_fin)){
            $data=Wechat::get()->where($title,'>=',$date_debut)->where($title,'<=',$date_fin);
            return view('admin.result')->with(compact('data','date_debut','date_fin','title'));
            //return redirect(url('admin/wechat'))->with(compact('data'));
        }
        else if (!empty($date_debut)&& empty($date_fin)){
            $data=Wechat::get()->where($title,'>=',$date_debut);
            return view('admin.result')->with(compact('data','date_debut','title'));
            //return redirect(url('admin/wechat'))->with(compact('data'));
        }
        else if (empty($date_debut)&& !empty($date_fin)){
            $data=Wechat::get()->where($title,'<=',$date_fin);
            return view('admin.result')->with(compact('data','date_fin','title'));
        }
        else if(empty($date_debut)&& empty($date_fin)){
            return redirect(url('admin/wechat'));
        }
    }
}
