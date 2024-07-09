<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\danhmuc;
use App\Models\Home;
use App\Models\sanpham;
use App\Models\users;
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
        $user = auth()->user();
        $cart = Cart::with(['cartItem.sanpham'])->where('user_id', $user->id)->first();

        $totalPrice = 0;

        if ($cart) {
            foreach ($cart->cartItem as $cartItem) {
                $totalPrice += $cartItem->so_luong * $cartItem->gia;
            }
        }
        // Mail::to("thuy1002dangthanh@gmail.com")->send(new OrderShipped(['ma'=>'1232311']));
        $ct_sp = new users();

        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
        $obj = new Home();
        $banner  = new Banner();
        $this->v['banner'] = $banner->LBanner();
        $this->v['Listsp'] = $obj->Listsp();
        return view('client.trangchu', $this->v, compact('cart','totalPrice'));
    }
    public function shopsp(Request $request)
    {
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
        $banner  = new Banner();
        $this->v['banner'] = $banner->LBanner();
        $obj = new Home();
        $this->v['extParams'] = $request->all();
        $this->v['Listsp'] = $obj->Listsp();
        return view('client.sanpham', $this->v);
    }
    public function detail($id, Request $request)
    {
        // $this->v['title'] = " chi tiết người dùng";
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
        $banner  = new Banner();
        $this->v['banner'] = $banner->LBanner();
        $test = new Home();
        $objitem  = $test->loadOne($id);
        // dd($objitem);
        $this->v['objitem'] = $objitem;
        return view('client.ct_sp', $this->v);
    }
    public function product_dm($id, Request $request)
    {
        $dm = new danhmuc();
        $this->v['dm'] = $dm->Danhmuc();
        $banner  = new Banner();
        $this->v['banner'] = $banner->LBanner();
        $sp = new Home();
        $this->v['extParams'] = $request->all();
        $this->v['id_dm'] = $sp->loadwithDm($id);
        return view('client.dmsp', $this->v);
    }
    public  function search(Request $request)
    {
        # code...
        $banner = new Banner();
        $this->v['banner'] = $banner->LBanner();
        $search  = sanpham::where('ten_sp', 'like', '%' . $request->key . '%')
            ->where('trang_thai', '!=', 2)
            ->get();
        return view('client.search', compact('search'), $this->v);
        // dd($search);

    }
    // public  function abc(Request $request)
    // {
    //     # code...
    //  $search = new sanpham();
    //  $this->v['search']= $search->FunctionName();
    //     // dd($search);

    // }

    // cart

}
