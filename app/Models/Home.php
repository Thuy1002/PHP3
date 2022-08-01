<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;
    protected $table = 'san_pham';
    protected $fillable  = ['ten_sp','gia','hinh_anh'];
  
    public function Listsp()
    {
      $query = DB::table($this->table)->where('trang_thai',1 )->get();
      return $query;
    }
    public function loadOne($id,$params = null)
    {
        $query = DB::table($this->table)->where('id','=', $id);
        $obj = $query->first();
        return $obj;
    }
}
