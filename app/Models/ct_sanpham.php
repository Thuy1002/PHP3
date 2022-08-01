<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ct_sanpham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';
    protected $fillable = ['ten_sp','gia','mo_ta','hinh_anh','so_luong'];
    
    public function loadoneSp($id){
        $query = DB::table($this->table)->where('id',$id);
        $obj = $query->first();
        return $obj;
    }

}
