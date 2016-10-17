<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Sentinel;
use App\User;
use Illuminate\Support\Facades\Input;

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
            $user->atasan_id = $request->atasan_id;
    		$user->status_pegawai = $request->status_pegawai;
            $user->npwp = $request->npwp;
            $user->nm_bank = $request->nm_bank;
            $user->nmrek = $request->nmrek;
            $user->rekening = $request->rekening;
            $user->gjpokok = $request->gjpokok;
            $user->tjistri = $request->tjistri;
            $user->tjanak = $request->tjanak;
            $user->tjupns = $request->tjupns;
            $user->tjstruk = $request->tjstruk;
            $user->tjfungs = $request->tjfungs;
            $user->tjdaerah = $request->tjdaerah;
            $user->tjpencil = $request->tjpencil;
            $user->tjlain = $request->tjlain;
            $user->tjkompen = $request->tjkompen;
            $user->pembul = $request->pembul;
            $user->tjberas = $request->tjberas;
    		$user->save();

	    	return Redirect::route('pegawai')->with('success', 'Pegawai berhasil ditambahkan');
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
            $user->atasan_id = $request->atasan_id;
            $user->status_pegawai = $request->status_pegawai;
            $user->npwp = $request->npwp;
            $user->nm_bank = $request->nm_bank;
            $user->nmrek = $request->nmrek;
            $user->rekening = $request->rekening;
            $user->gjpokok = $request->gjpokok;
            $user->tjistri = $request->tjistri;
            $user->tjanak = $request->tjanak;
            $user->tjupns = $request->tjupns;
            $user->tjstruk = $request->tjstruk;
            $user->tjfungs = $request->tjfungs;
            $user->tjdaerah = $request->tjdaerah;
            $user->tjpencil = $request->tjpencil;
            $user->tjlain = $request->tjlain;
            $user->tjkompen = $request->tjkompen;
            $user->pembul = $request->pembul;
            $user->tjberas = $request->tjberas;
    		$user->save();

	    	return Redirect::route('pegawai')->with('success', 'Data Pegawai berhasil dirubah');
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

    public function pegawaicreate(){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            return view('admin.pegawai.add');
        }
    }

    public function detailpegawai($id){
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            return view('admin.pegawai.detail')->with('id',$id);
        }
    }

    public function pegawaijson(Request $request){
        $count = User::where('unit_id','=',$request->unit_id)->count();
        if($count > 0){
           $user = User::where('unit_id','=',$request->unit_id)->get(); 
           return response()->json(['User' => $user]);
        }
    }

    public function pegawaiimportdata(Request $request){

        if (Input::hasFile('csv_file')){

            $file = Input::file('csv_file');
            $name = 'data-pegawai.csv';

            $path = 'uploads/CSV/';
            $file->move($path, $name);

            $data = $this->csvToArray($path. "/". $name);
            dd($data);
            for($i = 0; $i <= count($data); $i++){
                echo $data[$i]->nip."<br>";
            }

         }

        /*echo $request->csv_file;

        $file = public_path('file/test.csv');

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            User::firstOrCreate($customerArr[$i]);
        }*/
    }



    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
