<?php

namespace App\Http\Controllers;
use App\Models\User;

//import class "Str"
use Illuminate\Support\Str;

//import Model "User" dari folder models
use Illuminate\Http\Request;

//import class "Str"
use App\Http\Controllers\Controller;

//import class "Auth"
use Illuminate\Support\Facades\Auth;



class login_controller extends Controller
{
    public function login() {

        return view('login');


    }

    public function login_user(Request $request){

        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }

        return redirect('/login');

    }

    public function register() {

        return view('register');


    }

    public function register_user(Request $request) {

        // dd($request->all());

        User::create([

            'name' => $request->name,
            'email' => $request->email,

            // tag bcrypt untuk merubah text menjadi crypt data di field password
            'password' => bcrypt($request->password),

            'remember_token' => Str::random(60),

        ]);

        return redirect('/login');

    }

    public function logout(){

        Auth::logout();
        return redirect('/login');
    }
}
