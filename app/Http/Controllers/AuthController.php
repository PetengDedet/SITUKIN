<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Redirect;

class AuthController extends Controller
{
    //

    public function login()
    {
    	if(!Sentinel::check()){
			return view('login');
    	}else{
			return Redirect::route('dashboard');
    	}
    }

    public function loginPost(Request $request){
    	
    	$credentials = array(
		    'nip'    => $request->nip,
		    'password' => $request->password,
		);

		if(Sentinel::authenticate($credentials)){
			
			return Redirect::route('dashboard');
		}else{
			return Redirect::route('login')->with('error', 'NIP/Password tidak cocok');
		}
		
    }

    public function logout(){
		if(!Sentinel::check()){
			return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
    	}else{
			Sentinel::logout();
			return Redirect::route('login')->with('success', 'Anda berhasil logout');
    	}
    }
    
}
