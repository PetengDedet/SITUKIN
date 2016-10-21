<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Sentinel;
use App\User;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

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
            $user->golongan = $request->golongan;
            $user->kelas_jabatan = $request->kelas_jabatan;
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
            $user->golongan = $request->golongan;
            $user->kelas_jabatan = $request->kelas_jabatan;
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
            $rows = Excel::load($path. "/". $name)->get();
            $i = 0;
            foreach ($rows as $value) {
                if($value->nip){
                    $check = User::where('nip','=',$value->nip)->count();
                    if($check > 0){
                        //echo $value->nip." : ada<br>";
                        $user = User::where('nip','=',$value->nip)->first();
                        $user->kdsatker = str_replace('.0','',$value->kdsatker);
                        $user->kdanak = str_replace('.0','',$value->kdanak);
                        $user->kdsubanak = str_replace('.0','',$value->kdsubanak);
                        $user->nogaji = str_replace('.0','',$value->nogaji);
                        $user->kdjns = str_replace('.0','',$value->kdjns);
                        $user->name = str_replace('.0','',$value->nmpeg);
                        $user->kdduduk = str_replace('.0','',$value->kdduduk);
                        $user->kdgol = str_replace('.0','',$value->kdgol);
                        $user->npwp = str_replace('.0','',$value->npwp);
                        $user->nmrek = str_replace('.0','',$value->nmrek);
                        $user->nm_bank  = str_replace('.0','',$value->nm_bank);
                        $user->rekening = str_replace('.0','',$value->rekening);
                        $user->kdbankspan = str_replace('.0','',$value->kdbankspan);
                        $user->nmbankspan = str_replace('.0','',$value->nmbankspan);
                        $user->kdpos = str_replace('.0','',$value->kdpos);
                        $user->kdnegara = str_replace('.0','',$value->kdnegara);
                        $user->kdkppn = str_replace('.0','',$value->kdkppn);
                        $user->tipesup = str_replace('.0','',$value->tipesup);
                        $user->gjpokok = str_replace('.0','',$value->gjpokok);
                        $user->tjistri = str_replace('.0','',$value->tjistri);
                        $user->tjanak = str_replace('.0','',$value->tjanak);
                        $user->tjupns = str_replace('.0','',$value->tjupns);
                        $user->tjstruk = str_replace('.0','',$value->tjstruk);
                        $user->tjfungs = str_replace('.0','',$value->tjfungs);
                        $user->tjdaerah = str_replace('.0','',$value->tjdaerah);
                        $user->tjpencil = str_replace('.0','',$value->tjpencil);
                        $user->tjlain = str_replace('.0','',$value->tjlain);
                        $user->tjkompen = str_replace('.0','',$value->tjkompen);
                        $user->pembul = str_replace('.0','',$value->pembul);
                        $user->tjberas = str_replace('.0','',$value->tjberas);
                        $user->tjpph = str_replace('.0','',$value->tjpph);
                        $user->potpfkbul = str_replace('.0','',$value->potpfkbul);
                        $user->potpfk2 = str_replace('.0','',$value->potpfk2);
                        $user->potpfk10 = str_replace('.0','',$value->potpfk10);
                        $user->potpph = str_replace('.0','',$value->potpph);
                        $user->potswrum = str_replace('.0','',$value->potswrum);
                        $user->potkelbtj = str_replace('.0','',$value->potkelbtj);
                        $user->potlain = str_replace('.0','',$value->potlain);
                        $user->pottabrum = str_replace('.0','',$value->pottabrum);
                        $user->bersih = str_replace('.0','',$value->bersih);
                        $user->sandi = str_replace('.0','',$value->sandi);
                        $user->kdkawin = str_replace('.0','',$value->kdkawin);
                        $user->kdjab = str_replace('.0','',$value->kdjab);
                        $user->update();
                    }else{
                        //echo $value->nip." : kosong<br>";
                        $userNew = new User();
                        $userNew->nip = str_replace('.0','',$value->nip);
                        $userNew->kdsatker = str_replace('.0','',$value->kdsatker);
                        $userNew->kdanak = str_replace('.0','',$value->kdanak);
                        $userNew->kdsubanak = str_replace('.0','',$value->kdsubanak);
                        $userNew->nogaji = str_replace('.0','',$value->nogaji);
                        $userNew->kdjns = str_replace('.0','',$value->kdjns);
                        $userNew->name = str_replace('.0','',$value->nmpeg);
                        $userNew->kdduduk = str_replace('.0','',$value->kdduduk);
                        $userNew->kdgol = str_replace('.0','',$value->kdgol);
                        $userNew->npwp = str_replace('.0','',$value->npwp);
                        $userNew->nmrek = str_replace('.0','',$value->nmrek);
                        $userNew->nm_bank  = str_replace('.0','',$value->nm_bank);
                        $userNew->rekening = str_replace('.0','',$value->rekening);
                        $userNew->kdbankspan = str_replace('.0','',$value->kdbankspan);
                        $userNew->nmbankspan = str_replace('.0','',$value->nmbankspan);
                        $userNew->kdpos = str_replace('.0','',$value->kdpos);
                        $userNew->kdnegara = str_replace('.0','',$value->kdnegara);
                        $userNew->kdkppn = str_replace('.0','',$value->kdkppn);
                        $userNew->tipesup = str_replace('.0','',$value->tipesup);
                        $userNew->gjpokok = str_replace('.0','',$value->gjpokok);
                        $userNew->tjistri = str_replace('.0','',$value->tjistri);
                        $userNew->tjanak = str_replace('.0','',$value->tjanak);
                        $userNew->tjupns = str_replace('.0','',$value->tjupns);
                        $userNew->tjstruk = str_replace('.0','',$value->tjstruk);
                        $userNew->tjfungs = str_replace('.0','',$value->tjfungs);
                        $userNew->tjdaerah = str_replace('.0','',$value->tjdaerah);
                        $userNew->tjpencil = str_replace('.0','',$value->tjpencil);
                        $userNew->tjlain = str_replace('.0','',$value->tjlain);
                        $userNew->tjkompen = str_replace('.0','',$value->tjkompen);
                        $userNew->pembul = str_replace('.0','',$value->pembul);
                        $userNew->tjberas = str_replace('.0','',$value->tjberas);
                        $userNew->tjpph = str_replace('.0','',$value->tjpph);
                        $userNew->potpfkbul = str_replace('.0','',$value->potpfkbul);
                        $userNew->potpfk2 = str_replace('.0','',$value->potpfk2);
                        $userNew->potpfk10 = str_replace('.0','',$value->potpfk10);
                        $userNew->potpph = str_replace('.0','',$value->potpph);
                        $userNew->potswrum = str_replace('.0','',$value->potswrum);
                        $userNew->potkelbtj = str_replace('.0','',$value->potkelbtj);
                        $userNew->potlain = str_replace('.0','',$value->potlain);
                        $userNew->pottabrum = str_replace('.0','',$value->pottabrum);
                        $userNew->bersih = str_replace('.0','',$value->bersih);
                        $userNew->sandi = str_replace('.0','',$value->sandi);
                        $userNew->kdkawin = str_replace('.0','',$value->kdkawin);
                        $userNew->kdjab = str_replace('.0','',$value->kdjab);
                        /*dd($userNew);*/
                        $userNew->save();
                    }

                }else{
                    return Redirect::route('pegawai')->with('error', 'File Excel tidak valid');
                }
            }
            return Redirect::route('pegawai')->with('success', 'Data Pegawai berhasil diimport');
            /*$file = Input::file('csv_file');
            $name = 'data-pegawai.csv';

            $path = 'uploads/CSV/';
            $file->move($path, $name);

            $data = $this->csvToArray($path. "/". $name);

            if(isset($data[0]['nip'])){
                //echo "ada";
                for($i = 0; $i <= count($data); $i++){
                    echo $data[$i]['nip']."<br>";
                }
            }else{
                echo "kosong";
            }*/
            

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
