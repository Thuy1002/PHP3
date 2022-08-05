<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\danhmuc;
use App\Models\Home;
use App\Models\sanpham;
use App\Models\test1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    // 
    public function __construct()
    {
     $this->v = [];   
    }
    public function showsp()
    {
        // Mail::to("thuy1002dangthanh@gmail.com")->send(new OrderShipped(['ma'=>'1232311']));
        $ct_sp = new test1();

        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
       $obj = new Home();
       $this->v['Listsp'] = $obj ->Listsp();
       return view('client.trangchu',$this->v);

    }
    public function shopsp(Request $request)
    {
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
       $obj = new Home();
       $this->v['extParams'] = $request->all();
       $this->v['Listsp'] = $obj ->Listsp();
       return view('client.sanpham',$this->v);

    }
    public function detail($id, Request $request)
    {
        // $this->v['title'] = " chi tiết người dùng";
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
        $test = new Home();
        $objitem  = $test->loadOne($id);
        // dd($objitem);
        $this->v['objitem'] = $objitem;
        return view('client.ct_sp', $this->v);
    }
     public function product_dm($id,Request $request)
    {
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
       $sp = new Home();
       $this->v['extParams'] = $request->all();
       $this->v['id_dm'] = $sp->loadwithDm($id);
        return view('client.dmsp',$this->v);
    }
    
}
