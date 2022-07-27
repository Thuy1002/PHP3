<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class abc extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $abc = ['id','ten_sv','ngay_sinh','nganh_hoc'];
     public function loadAbc($params = [])
    {
        $query = DB::table($this->table)
        ->select($this->abc);
        $listabc = $query->get();
        return $listabc;
    }

}
