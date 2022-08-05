<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanphamRequest;
use App\Models\danhmuc;
use App\Models\sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class spController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index(Request $request ){// 
        $this->v['tieude'] = ['san pham'];
        $object = new sanpham();
        $this->v['extParams'] = $request->all();
        $this->v['list'] = $object->listsp();
        return view('admin.sanpham.index',$this->v);
    }
    // public function sanpham(Request $request)
    // {
    //     $this->v['tieude']=['san pham'];
    //     $object = new sanpham();
    //     $this->v['extParams'] = $request->all();
    //     $this->v['list'] = $object->listsp();
    //     //dd($users);
    //     // $this->v['tests'] = $tests;
    //     return view('admin.sanpham.index', $this->v);
    // }

    public function add(SanphamRequest $request){
        $this->v['_title'] = "them nguoi dung";
        $method_route = 'route_BackEnd_Sanpham_Add';
        $method_route_index = 'route_BackEnd_Sanpham_Index';
        $dm = new danhmuc();
            $this->v['tieude']= "thêm sản phẩm";
            // dd($dm->Danhmuc());
            $this->v['dm'] = $dm->Danhmuc();
    
        if($request->isMethod('post')){ // check nếu là post chạy cậu lệnh dưới
            $params = [];
            $params['cols'] = array_map(function($item){ //array_map chạy lần lượt qua các phần tử của mảng
              if($item == '')
                $item = null;
            
              if(is_string($item))
                $item = trim($item); //bỏ khoảng chống
             
              return $item;
            },
            $request->post());
            unset($params['cols']['_token']);
            // dd($params['cols']);
            $src =  $request->file('hinh_anh')->store('public/images');//store lưu chữ các file ảnh
            $src = str_replace('public/images/', "", $src);
            $modelTest = new sanpham();
            $res = $modelTest->saveNew($params,$src);
            if ($res == null) {
                # code...
                redirect()->route($method_route);
            }elseif($res> 0 ){
                Session::flash('success','Thêm sản phẩm thành công');
                return redirect() ->route($method_route_index);
            }else {
                Session::flash('arro','Lỗi thêm mới');
                redirect()->route($method_route) ;
            }
            // dd($params['cols']);
        }
        return view('admin.sanpham.add', $this->v);
    }

    public function detailSp($id, Request $request)
    {
        $this->v['title'] = " chi tiết sản phẩm";
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
        $test = new sanpham();
        $objitem  = $test ->loadOneSP($id);
        // dd($objitem);
        $this->v['objitem_sp'] = $objitem;
        return view('admin.sanpham.detail', $this->v);
    }
    public function updateSp($id,Request $request){

    }



    public function destroy($id)
    {
        $method_route_sp = 'route_BackEnd_Sanpham_Index';
        $model = new sanpham();
        $res = $model->Xoa($id);

        if ($res == null) {
            # code...
            return  redirect()->route($method_route_sp);
        } elseif ($res > 0) {
            Session::flash('success', 'Xóa sản phẩm '.$id.'thành công');

            return   redirect()->route($method_route_sp);
        } else {
            Session::flash('erro', 'Xóa lỗi');
            redirect()->route($method_route_sp);
        }
        return redirect()->route($method_route_sp);
    }
    
}
