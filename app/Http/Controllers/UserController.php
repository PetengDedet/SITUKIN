<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Sentinel;
use App\User;

class UserController extends Controller
{
    //
    public function listpegawai(){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            return view('admin.pegawai.list');
        }
    }

    public function simpanpegawai(Request $request){
    	if(!Sentinel::check()){
			return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
    	}else{
    		$user = new User();
    		$user->nip = $request->nip;
    		$user->name = $request->name;
    		$user->unit_id = $request->unit_id;
    		$user->jabatan_id = $request->jabatan_id;
    		$user->gaji_pokok = $request->gaji_pokok;
    		$user->save();

	    	return Redirect::route('dashboard')->with('success', 'Pegawai berhasil ditambahkan');
	    }
    }

    public function editpegawai(Request $request){
    	if(!Sentinel::check()){
			return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
    	}else{
    		$user = User::find($request->id);
    		$user->nip = $request->nip;
    		$user->name = $request->name;
    		$user->unit_id = $request->unit_id;
    		$user->jabatan_id = $request->jabatan_id;
    		$user->gaji_pokok = $request->gaji_pokok;
    		$user->save();

	    	return Redirect::route('dashboard')->with('success', 'Data Pegawai berhasil dirubah');
	    }
    }

    public function deletepegawai($id){
    	if(!Sentinel::check()){
			return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
    	}else{
    		User::where('id','=',$id)->delete();
    		return Redirect::route('dashboard')->with('success', 'Pegawai berhasil dihapus');
    	}
    }
    public function userjson(Request $request){
    	if(!Sentinel::check()){
			return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
    	}else{
    		$count = User::where('id','=',$request->id)->count();
	        if($count > 0){
	           $user = User::where('id','=',$request->id)->first(); 
	           return response()->json(['User' => $user]);
	        }
    	}
    }
}
