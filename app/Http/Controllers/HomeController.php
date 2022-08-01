<?php

namespace App\Http\Controllers;

use App\Models\danhmuc;
use App\Models\Home;
use App\Models\sanpham;
use App\Models\test1;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 
    public function __construct()
    {
     $this->v = [];   
    }
    public function showsp()
    {
        $ct_sp = new test1();

        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
       $obj = new Home();
       $this->v['Listsp'] = $obj ->Listsp();
       return view('client.trangchu',$this->v);

    }
    public function shopsp()
    {
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
       $obj = new Home();
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

    
}
