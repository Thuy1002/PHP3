<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhmucRequest;
use App\Models\danhmuc;
use App\Models\sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DmController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }
    public function index(Request $request)
    {
        $this->v['_tieude'] = ['danh muc'];
        $object = new danhmuc();
        $this->v['extParams'] = $request->all();
        $this->v['listdm'] = $object->listdanhmuc();
        return view('admin.danhmuc.index', $this->v);
    }


    public function add(DanhmucRequest $request)
    {
        $method_route_dm = 'route_BackEnd_Danhmuc_Index';
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
            $modelDm = new danhmuc();
            $res = $modelDm->Savedm($params);
            if ($res == null) {
                # code...
                redirect()->route($method_route_dm);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công danh mục');

                return   redirect()->route($method_route_dm);
            } else {
                Session::flash('arro', 'Lỗi thêm danh mục');
                redirect()->route($method_route_dm);
            }
            // dd($params['cols']);
        }
        return view('admin.danhmuc.add', $this->v);
    }

    public function detailDm($id, Request $request)
    {
        $this->v['title'] = " Chi tiết danh mục";
        $test = new danhmuc();
        $objitem  = $test ->loadOneDm($id);
        // dd($objitem);
        $this->v['objitem'] = $objitem;
        return view('admin.danhmuc.detail', $this->v);
    }

    public function updateDm($id,DanhmucRequest $request){
        $method_route_detailDm = "route_BackEnd_Danhmuc_detail";
        $method_router_indexDm = "route_BackEnd_Danhmuc_update";
        $params = []; 
        $params['cols'] = array_map(function($item){
            if($item == '')
            $item = null;
            if(is_string($item))
            $item = trim($item);
            return $item;
        },$request->post());
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        // $params['cols']['password']  = Hash::make($params['cols']['password']);
        $test = new danhmuc();
        $res = $test->SaveupdateDm($params);
        if($res == null){
            return redirect()->route($method_route_detailDm,['id'=>$id]);
        }
        elseif($res == 1){
            Session::flash('success','cập nhật bản ghi '.$id.'thành công');
            return redirect()->route($method_router_indexDm,['id'=>$id]);
        }
        else{
            Session::flash('success','lỗi cập nhật bản ghi '.$id);
            return redirect()->route($method_route_detailDm,['id'=>$id]);
        }
    }
    public function destroy($id)
    {
        $method_route_dm = 'route_BackEnd_Danhmuc_Index';
        $model = new danhmuc();
        $res = $model->Xoa($id);

        if ($res == null) {
            # code...
            redirect()->route($method_route_dm);
        } elseif ($res > 0) {
            Session::flash('success', 'Xóa thành công danh mục');

            return   redirect()->route($method_route_dm);
        } else {
            Session::flash('arro', 'Xóa lỗi');
            redirect()->route($method_route_dm);
        }
        return redirect()->route($method_route_dm);
    }

    public function product_dm($id,Request $request)
    {
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
       $sp = new sanpham();
       $this->v['extParams'] = $request->all();
       $this->v['id_dm'] = $sp->loadwithDm($id);
        return view('admin.danhmuc.dmsp',$this->v);
    }
}
