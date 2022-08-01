<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class sanpham extends Model
{
    use HasFactory;
    protected $table = "san_pham";
    protected $fillable = ['id','gia','hinh_anh','ten_sp','so_luong','mo_ta','trang_thai','id_danhmuc'];
     public function listsp($params = [])
    {
        $query = DB::table($this->table)->select($this->fillable)->where('trang_thai',1 )->orWhere('trang_thai',0);
        $list = $query->paginate(5);
        return $list;
    }
    public function saveNew($params,$src)
    {
        $data = array_merge($params['cols'],[ //array_ có rồi thì cập nhật không có thì thêm 
            'hinh_anh'=>$src,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            // 'level'=>1,
        ]);
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }
    public function loadOne($id,$params = null)
    {
        $query = DB::table($this->table)->where('id','=', $id);
        $obj = $query->first();
        return $obj;
    }
    public function Xoa($id)
    {
      $res= DB::table($this->table)->where('id',$id)->update(['trang_thai'=>2]) ;
      return $res;
    }
   



}
