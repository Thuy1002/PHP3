<?php

namespace App\Http\Controllers;

use App\Models\ct_sanpham;
use App\Models\danhmuc;
use App\Models\sanpham;
use Illuminate\Http\Request;

class CtspController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function detailSp($id, Request $request)
    {
        $this->v['title'] = " chi tiết người dùng";
        $dm = new danhmuc();
        $sp = new sanpham();
        $this->v['sp']= $sp->listsp_2();
        $this->v['dm'] = $dm->Danhmuc();
        $ctsp = new ct_sanpham();
        $objitem  = $ctsp ->loadoneSp($id);
        // dd($objitem);
        $this->v['objitem'] = $objitem;
        return view('client.ct_sp', $this->v);
    }
}
