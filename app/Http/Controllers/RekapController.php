<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Unit;
use Redirect;
use Sentinel;
use DB;

class RekapController extends Controller
{
    //
    public function rekapdata()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	return view('admin.rekapdata.list');
        }
    }


    public function update(){
    	$data = DB::table('table 19')->get();

    	foreach($data as $datas){
            $idBaru = $datas->id + 430;
			DB::table('table 19')->where('id','=',$datas->id)->update(['id'=>$idBaru]);
    	}
    }
}
