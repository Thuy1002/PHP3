<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
    public function listsp_2($params = [])
    {
        $query = DB::table($this->table)->select($this->fillable)->where('trang_thai',1 )->orWhere('trang_thai',0)->get();
        return $query;
    }
    public function saveNew($params)
    {
        $data = array_merge($params['cols']);
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }
    public function loadOneSp($id,$params = null)
    {
        $query = DB::table($this->table)->where('id','=', $id);
        $obj = $query->first();
        return $obj;
    }
    public function SaveSp($params)
    {
      if(empty($params['cols']['id'])){
        Session::flash('erro','không xác định được bản ghi cập nhật');
        return null;
      }
      $data_update = [];
      foreach($params['cols'] as $colName =>$val){
        if($colName == 'id') continue;
        if(in_array($colName,$this->fillable)){
            $data_update[$colName] = (strlen($val) == 0)? null : $val;

        }
      }
      $res = DB::table($this->table)->where('id',$params['cols']['id'])
      ->update($data_update);
      return $res;
    }


    public function Xoa($id)
    {
      $res= DB::table($this->table)->where('id',$id)->update(['trang_thai'=>2]) ;
      return $res;
    }



}
