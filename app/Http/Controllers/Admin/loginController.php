<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;

use Symfony\Component\Console\Input\Input;

class loginController extends Controller
{
   public function getLogin() {
      
      return view('admin.auth.login');
      }
      public function Login(LoginRequest $request){
$member_me=$request->has('remember_me')?'true':'false';
if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
   // notify()->success('تم الدخول بنجاح');
   // return redirect()->route('admin.dashboard');
   return redirect('admin/dashboard');
}
// notify()->error('خطاء في الاميل او في البسورد');
return redirect()->back()->with(['error'=>'هناك خطاء في البينات']);
      }
}
