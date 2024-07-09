<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $fillable = ['sanpham_id','cart_id','so_luong','gia'];

    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
    public function sanpham(){
        return $this->belongsTo(sanpham::class,'sanpham_id');
    }
}
