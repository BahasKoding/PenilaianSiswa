<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function auth(Request $request){
        $request->validate([
            'name'      =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('name','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        return redirect("/")->withErrors("Login tidak berhasil, username atau password salah");
    }

    public function dashboard(){
        if(Auth::check()){
            $data = [
                'pageTitle' => 'Dashboard'
            ];
            return view('dashboard.index', $data);
        }

        return redirect("/")->withErrors("ente lom login mana boleh masuk");
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
