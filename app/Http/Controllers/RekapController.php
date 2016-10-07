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
        	return view('admin.rekap.list');
        }
    }


    public function update(){
    	/*$data = DB::table('jabatan')->get();

    	foreach($data as $datas){
			$unit = DB::table('unit')->get();

			foreach ($unit as $units) {
				if($units->nama_unit == $datas->nama_jabatan){
					DB::table('jabatan')->where('id','=',$datas->id)->delete();
				}
			}
    	}*/
    }
}
