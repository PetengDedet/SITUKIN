<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Unit;
use Redirect;
use Sentinel;

class RekapController extends Controller
{
    //
    public function rekapdata()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	return view('admin.rekap.list');
        }
    }
}
