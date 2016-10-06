<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Http\Requests;

class UserController extends Controller
{
    //
    public function simpanpegawai(Request $request){
    	return Redirect::route('dashboard')->with('success', 'Pegawai berhasil ditambahkan');
    }
}
