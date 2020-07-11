<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        return view('admin.login');
    }

    public function post_login(Request $request)
    {
       if(Auth::attempt($request->only('email','password'))){
       	return redirect()->route('admin.index');
       }else{
       	return redirect()->route('admin.login');
       }
    }
     public function logout()
    {
      // dd('qww');
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function error(){
      $code = request()->code;
      $errors = config('error.'.$code);
      return view('admin.error',$errors);
    }
}
