<?php

namespace App\Http\Controllers;

use App\Models\abc;
use Illuminate\Http\Request;

class AbcController extends Controller
{
    private $v ;
    public function __construct()
    {
        $this->v=[];
    }
     public function FunctionName()
    {
     $object = new abc();
     $abc = $object->loadAbc();
     $this->v['abc'] = $abc;
     return view('test.abc',$this->v);
    }
}
