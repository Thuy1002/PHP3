<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class test1 extends Model
{
    use HasFactory;
    protected  $table = 'users';
    protected $fillable = ['id','name','email'];
     public function loadlist($params = [])
    {
        $query = DB::table($this->table)
        ->select($this->fillable);
        $lists = $query->get();
        return $lists;
    }
    public function loadListWithPager($params= []){// phân trang 
        $query  = DB::table($this->table)
        ->select($this->fillable);
        $list =$query->paginate(5);
        return $list;
    }
    public function saveNew($params)
    {
        $data = array_merge($params['cols'],[ //array_ có rồi thì cập nhật không có thì thêm 
            'password'=>Hash::make($params['cols']['password']),
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
    public function Saveupdate($params)
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
}
