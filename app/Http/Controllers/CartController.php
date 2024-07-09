<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\sanpham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addCart(Request $request) // thêm giỏ hàng khi không truyền id
    {
        $user = auth()->user();
        $product = sanpham::where('ten_sp', $request->ten_sp)->first();;

        if (!$product) {
            return back()->with('error', 'sản phẩm không tồn tại');
        }

        $cart = Cart::firstOrCreate(['user_id' => $user->id]); // tìm hoắc tạo mới cart
        $cartItem  = $cart->cartItem()->where('sanpham_id', $product->id)->first(); // tìm sản phảm trong giỏ hàng
        // dd( $cartItem);
        if ($cartItem) {
            $cartItem->so_luong += $request->quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có, tạo mới mục giỏ hàng
            $cart->cartItem()->create([
                'sanpham_id' => $product->id,
                'so_luong' => $request->input('quantity', 1),
                'gia' => $request->gia
            ]);
        }
        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }
}
