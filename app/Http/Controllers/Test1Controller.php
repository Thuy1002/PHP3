<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\test1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Test1Controller extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index(Request $request)
    {
        $this->v['tieude'] = ['nguoi dung'];
        $object = new test1();
        $this->v['extParams'] = $request->all();
        $this->v['list'] = $object->loadListWithPager();
        //dd($users);
        // $this->v['tests'] = $tests;
        return view('admin.nguoidung.index', $this->v);
    }
    //phương thức add
    public function add(UserRequest $request)
    {
        $this->v['_title'] = "them nguoi dung";
        $method_route = 'route_BackEnd_Uesr_Add';
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
            $modelTest = new test1();
            $res = $modelTest->saveNew($params);
            if ($res == null) {
                # code...
                redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'them moi thanh cong nguoi dung');
            } else {
                Session::flash('arro', 'loi them moi');
                redirect()->route($method_route);
            }
            // dd($params['cols']);
        }
        return view('admin.nguoidung.add', $this->v);
    }
    public function detail($id, Request $request)
    {
        $this->v['title'] = " chi tiết người dùng";
        $test = new test1();
        $objitem  = $test->loadOne($id);
        // dd($objitem);
        $this->v['objitem'] = $objitem;
        return view('admin.nguoidung.detail', $this->v);
    }
    // public function destroy($id){
    //     $news = new test1($id);

    //     $news->delete();
    //     return redirect()->action('admin.nguoidung.index')->with('success','Dữ liệu xóa thành công.');
    // }
    
  
}
