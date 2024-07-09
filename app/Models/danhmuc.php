<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class danhmuc extends Model
{
  use HasFactory;
  protected  $table = 'danh_muc';
  protected $fillable = ['id', 'ten_danhmuc'];
  public function listdanhmuc($params = []) //show theo phân trang
  {
    $query = DB::table($this->table)->select($this->fillable)->where('trang_thai', 1);
    $listdm = $query->paginate(5);
    return $listdm;
  }



  public function Danhmuc() //show danh sách
  {
    $query = DB::table($this->table)->where('trang_thai', 1)->get();
    return $query;
  }


  public function Savedm($params)
  {
    $data = array_merge($params['cols']);
    $res  = DB::table($this->table)->insertGetId($data);
    return $res;
  }



  public function loadOneDm($id, $params = null)
  {
    $query = DB::table($this->table)->where('id', '=', $id);
    $obj = $query->first();
    return $obj;
  }


  public function SaveupdateDm($params)
  {
    if (empty($params['cols']['id'])) {
      Session::flash('erro', 'không xác định được bản ghi cập nhật');
      return null;
    }
    $data_update = [];
    foreach ($params['cols'] as $colName => $val) {
      if ($colName == 'id') continue;
      if (in_array($colName, $this->fillable)) {
        $data_update[$colName] = (strlen($val) == 0) ? null : $val;
      }
    }
    $res = DB::table($this->table)->where('id', $params['cols']['id'])
      ->update($data_update);
    return $res;
  }

  public function Xoa($id)
  {
    $res = DB::table($this->table)->where('id', $id)->update(['trang_thai' => 0]);
    DB::table('san_pham')->where('id_danhmuc', $id)->update(['trang_thai' => 2]);
    return $res;
  }


  // 
  public function san_pham()
  {
   return $this->hasMany(sanpham::class);
  }
}
