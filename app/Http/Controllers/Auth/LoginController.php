<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function getLogin(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
      //  dd($request -> all())
        $rules = [  //kiểm tra dữ liệu đầu vào
            'email'=>'required | email',
            'password'=>'required'
        ];
        $messages = [
            'email.required'=>'Chưa nhập Email',
            'email.email'=>'Vui lòng nhập đúng Email',
            'password.required'=>'Chưa nhập password'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
      // dd($validator);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }else {
            $email  = $request->input('email');//đón dữ liệu từ bên trang login gửi sang
        
            $password = $request->input('password');
           //Auth::attempt(): Đây là phương thức check input data có hợp lệ không,
           // nếu hợp lệ sẽ trả về true và ngược lại. 
            if (Auth::attempt(['email'=>$email,'password'=>$password])) { 
                return redirect('test');
            }else {
               Session::flash('error','Email hoặc mật khẩu không đúng');
               return redirect('login')->withErrors($validator)->withInput();
            }
        }
    }
    public function getlogout(){
        Auth::logout();
        return redirect('login');
    }
    
}
