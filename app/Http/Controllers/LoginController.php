<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $redirectTo = '/home';
    public function showRegistrationForm()
    {
        return view('auth.register2');
    }
    public function redirectTo(){    
        if(Auth::user()->role_id == 2){
            //假如是一般使用者
            return '/home';
        }else if(Auth::user()->role_id == 1){
            //假如是管理員
            return '/admin';
        }else{
            return '/login';
        }
    }
}
