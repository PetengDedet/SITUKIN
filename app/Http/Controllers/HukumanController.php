<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\HukumanPegawai;
use App\HukumanDisiplin;
use Redirect;
use Sentinel;
use DB;

class HukumanController extends Controller
{
    //
    public function hukumandisiplin()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	return view('admin.hukuman.list');
        }
    }

    public function hukumandisiplintambah(){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            return view('admin.hukuman.add');
        }
    }

    public function hukumandisiplinsimpan(Request $request){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $dataHukuman = HukumanDisiplin::where('id','=',$request->hukuman_id)->first();
            //date('Y-m-d', strtotime("+".$dataHukuman->lama_potongan." months", strtotime($effectiveDate)));

            $berakhir = date("Y-m-d H:i:s", strtotime("+".$dataHukuman->lama_potongan." months"));

            $hukuman = new HukumanPegawai();
            $hukuman->hukuman_id = $request->hukuman_id;
            $hukuman->user_id = $request->user_id;
            $hukuman->berakhir = $berakhir;
            $hukuman->save();

            return Redirect::route('hukumandisiplin')->with('success', 'Hukuman berhasil ditambahkan');
        }
    }

    public function deletehukuman($id){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            HukumanPegawai::where('id','=',$id)->delete();
            return Redirect::route('hukumandisiplin')->with('success', 'Hukuman berhasil dihapus');
        }
    }

    public function hukumandisiplindetail($id){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            HukumanPegawai::where('id','=',$id)->delete();
            return Redirect::route('hukumandisiplin')->with('success', 'Hukuman berhasil dihapus');
        }
    }

}
