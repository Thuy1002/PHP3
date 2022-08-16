<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;
    protected $table = 'san_pham';
    protected $fillable  = ['ten_sp','gia','hinh_anh','trang_thai'];
  
    public function Listsp()
    {
      $query = DB::table($this->table)->where('trang_thai','!=',2 );
      $list = $query->paginate(6);
      return $list;
    }
    public function loadOne($id,$params = null)
    {
        $query = DB::table($this->table)->where('id','=', $id);
        $obj = $query->first();
        return $obj;
    }
    public function loadwithDm($id){
      $res = DB::table($this->table)->where('id_danhmuc',$id)->where('trang_thai','!=',2);
      $list = $res->paginate(6);
      return $list;
    }
  
}
