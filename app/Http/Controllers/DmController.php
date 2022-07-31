<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhmucRequest;
use App\Models\danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DmController extends Controller
{
    public function __construct()
    {
        $this->v = []; 
       }
  public function index(Request $request){
    $this->v['tieude'] = ['danh muc'];
    $object = new danhmuc();
    $this->v['extParams'] = $request->all();
    $this->v['listdm'] = $object ->listdanhmuc();
    return view('admin.danhmuc.index',$this->v);
  }
  public function add(Request $request ){
   $method_route = 'route_BackEnd_Danhmuc_Index';
   if ($request->isMethod('post')) {
    $params = [];
    $params['cols'] = array_map(
        function ($item) {
            if ($item == '')
                $item = null;

            if (is_string($item))
                $item = trim($item); //bỏ khoảng chống

            return $item;
        },
        $request->post()
    );
    unset($params['cols']['_token']);
    $modelTest = new danhmuc();
    $res = $modelTest->Savedm($params);
    if ($res == null) {
        # code...
        redirect()->route($method_route);
    } elseif ($res > 0) {
        Session::flash('success', 'Thêm mới thành công danh mục');
    } else {
        Session::flash('arro', 'Lỗi thêm danh mục');
        redirect()->route($method_route);
    }
    // dd($params['cols']);
}
return view('admin.danhmuc.add', $this->v);
}
}
