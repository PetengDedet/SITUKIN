<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use PDF;
use MPDF;
use App\User;
use App\Jabatan;
use App\Grade;
use App\KinerjaBulanan;
use App\PotonganAbsensi;
use App\PotonganDisiplin;
use App\Role;
use App\Unit;

use App\Library\RoleLib;
use Sentinel;
use Redirect;

class ReportController extends Controller
{
    //
    public function export($unit, $bulan, $tahun)
    {
    	// dd($unit);
    	// $this->validate($r, [

    	// ]);
		if(!RoleLib::limitThis(4, Sentinel::getUser()->id)) {
        	abort(404);
        }

        $data = [];
        $users = User::where('nip','!=','admin')->where('nip','!=','123')->take(10)->get();

        foreach ($users as $k => $v) {
        	$data['pegawai'][] = $v;
        	$data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();
        	//Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
        	$data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
        	$data['grade'][] = Grade::where('id', $v->kelas_jabatan)->first();

        	//Potongan Absesi
        	$data['absensi'][] = PotonganAbsensi::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();
        	//Potongan Disiplin
        	$data['disiplin'][] = PotonganDisiplin::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();

        	//echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
        	//echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
        	$data['tkjb'][] = ($data['grade'][$k]->tunjangan_kinerja * $data['dataKinerja'][$k]->persentase)/100;

        	//Tunjangan Kinerja Yang diterima
        	// echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
        	// echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
        	$data['tkjbpa'][] = ($data['tkjb'][$k] * $data['absensi'][$k]->total_potongan_absen)/100;
        	$data['tkjbhd'][] = ($data['tkjb'][$k] * $data['disiplin'][$k]->persentase)/100;
        	$data['tkjd'][] = $data['tkjb'][$k] - ($data['tkjbpa'][$k] + $data['tkjbhd'][$k]);

			// echo "Tunjangan Yang diterima = " . $tkjd;	
        	// echo "<hr>";

        }

        // return view('report.2back',compact('data',$data));
        $pdf = PDF::loadView('report.pembayaran',compact('data',$data));
        return $pdf->setPaper(array(0,0,612.00,936.00), 'landscape')->stream('report.pdf');
    }


    public function export2($unit, $bulan, $tahun)
    {
    	// dd($unit);
    	// $this->validate($r, [

    	// ]);
		if(!RoleLib::limitThis(4, Sentinel::getUser()->id, $redirect_to = null)) {
        	abort(404);
        }

        $data = [];
        $users = User::where('unit_id', $unit)->get();

        foreach ($users as $k => $v) {
        	$dataKinerja = KinerjaBulanan::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();
        	//Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
        	$jabatan = Jabatan::where('id', $v->jabatan_id)->first();
        	$grade = Grade::where('id', $v->kelas_jabatan)->first();

        	//Potongan Absesi
        	$absensi = PotonganAbsensi::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();
        	//Potongan Disiplin
        	$disiplin = PotonganDisiplin::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();

        	echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
        	echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
        	$tkjb = ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100;

        	//Tunjangan Kinerja Yang diterima
        	echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
        	echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
        	$tkjbpa = ($tkjb * $absensi->total_potongan_absen)/100;
        	$tkjbhd = ($tkjb * $disiplin->persentase)/100;
        	$tkjd = $tkjb - ($tkjbpa + $tkjbhd);

			echo "Tunjangan Yang diterima = " . $tkjd;	
        	echo "<hr>";

        }


        //
        // dd($data);
    }

    public function select()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            return view('report.index');
        }
    }

    public function perGolonganJabatan()
    {
        return view('report.perGolonganJabatan');
    }

    public function realisasi()
    {
        $pdf = PDF::loadView('report.realisasi');
        return $pdf->setPaper(array(0,0,612.00,936.00), 'potrait')->stream('report.pdf');
        // return view('report.realisasi');
    }

    public function invoice()
    {
        return view('report.invoice');
    }

    public function protakel()
    {
        return view('report.protakel');
    }

    public function sdm()
    {
        return view('report.sdm');
    }

    public function pembayaran()
    {
        return view('report.pembayaran');
    }

    public function exportdata($unit_id = "", $eselon_satu){
        $getData = Sentinel::getUser();
        $getRole = Role::where('user_id','=',$getData->id)->first();
        //return view('report.pembayaran')->with('unit_id', $getData->unit_id);
        $data['eselon_satu'] = $eselon_satu;
        if($unit_id){
            $data['unit_id'] = $unit_id;
        }else{
            $data['unit_id'] = $getData->unit_id;
        }
        

        
        
    
            $pdf = PDF::loadView('report.sdm',compact('data', $data));
            return $pdf->setPaper(array(0,0,612.00,936.00), 'potrait')->stream('report.pdf');
        
    }

    public function exportDatas(Request $request){
        $checkDataUser = User::where('unit_id', $request->unit_id)->count();

        if($checkDataUser > 0){
            $getDataUser = User::where('unit_id', $request->unit_id)->get();

            $totalDataKinerjaBulanan = 0;
            $totalDataPotonganAbsen = 0;
            $totalDataHukumanDisiplin = 0;

            foreach ($getDataUser as $dataUser) {
                $checkDataKinerjaBulanan = KinerjaBulanan::where('bulan',$request->bulan)->where('tahun',$request->tahun)->where('pegawai_id',$dataUser->id)->count();
                $checkDataPotonganAbsensi = PotonganAbsensi::where('bulan',$request->bulan)->where('tahun',$request->tahun)->where('pegawai_id',$dataUser->id)->count();
                $checkDataPotonganDisiplin = PotonganDisiplin::where('bulan',$request->bulan)->where('tahun',$request->tahun)->where('pegawai_id',$dataUser->id)->count();

                if($checkDataKinerjaBulanan > 0){
                    $totalDataKinerjaBulanan++;
                }

                if($checkDataPotonganAbsensi > 0){
                    $totalDataPotonganAbsen++;
                }

                if($checkDataPotonganDisiplin > 0){
                    $totalDataHukumanDisiplin++;
                }
            }
            /*echo $totalDataKinerjaBulanan. " : ". count($getDataUser)."<br>";
            echo $totalDataPotonganAbsen. " : ". count($getDataUser)."<br>";
            echo $totalDataHukumanDisiplin. " : ". count($getDataUser)."<br>";*/

            if($totalDataKinerjaBulanan == count($getDataUser) && $totalDataPotonganAbsen == count($getDataUser) &&$totalDataHukumanDisiplin == count($getDataUser)){
                if($request->type == "3"){
                    $data = [];
                    $data['pejabat_pembuat_komitmen'] = $request->pejabat_pembuat_komitmen;
                    $data['bendahara'] = $request->bendahara;
                    $data['belanja_pegawai'] = $request->belanja_pegawai;
                    $data['bulan'] = $request->bulan;
                    $data['tahun'] = $request->tahun;
                    $users = User::where('unit_id',$request->unit_id)->where('nip','!=','admin')->where('nip','!=','123')->get();

                    foreach ($users as $k => $v) {
                        $data['pegawai'][] = $v;
                        $data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        //Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
                        $data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
                        $data['grade'][] = Grade::where('id', $v->kelas_jabatan)->first();

                        //Potongan Absesi
                        $data['absensi'][] = PotonganAbsensi::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        //Potongan Disiplin
                        $data['disiplin'][] = PotonganDisiplin::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();

                        //echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
                        //echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
                        $data['tkjb'][] = ($data['grade'][$k]->tunjangan_kinerja * $data['dataKinerja'][$k]->persentase)/100;

                        //Tunjangan Kinerja Yang diterima
                        // echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
                        // echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
                        $data['tkjbpa'][] = ($data['tkjb'][$k] * $data['absensi'][$k]->total_potongan_absen)/100;
                        $data['tkjbhd'][] = ($data['tkjb'][$k] * $data['disiplin'][$k]->persentase)/100;
                        $data['tkjd'][] = $data['tkjb'][$k] - ($data['tkjbpa'][$k] + $data['tkjbhd'][$k]);
                        

                    }

                    /*return view('report.2back',compact('data',$data));*/
                    $pdf = PDF::loadView('report.pembayaran',compact('data',$data));
                    return $pdf->setPaper(array(0,0,612.00,936.00), 'landscape')->stream('report.pdf');
                }else if($request->type == "4"){
                    $data = [];
                    $data['pejabat_pembuat_komitmen'] = $request->pejabat_pembuat_komitmen;
                    $data['bendahara'] = $request->bendahara;
                    $data['belanja_pegawai'] = $request->belanja_pegawai;
                    $data['bulan'] = $request->bulan;
                    $data['tahun'] = $request->tahun;
                    $users = User::where('unit_id',$request->unit_id)->where('nip','!=','admin')->where('nip','!=','123')->get();

                    foreach ($users as $k => $v) {
                        $data['pegawai'][] = $v;
                        $data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        // 
                        $data['unit'][] = Unit::where('id', $v->unit_id)->first();
                        //Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
                        $data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
                        $data['grade'][] = Grade::where('id', $v->kelas_jabatan)->first();

                        //Potongan Absesi
                        $data['absensi'][] = PotonganAbsensi::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        //Potongan Disiplin
                        $data['disiplin'][] = PotonganDisiplin::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();

                        //echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
                        //echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
                        $data['tkjb'][] = ($data['grade'][$k]->tunjangan_kinerja * $data['dataKinerja'][$k]->persentase)/100;

                        //Tunjangan Kinerja Yang diterima
                        // echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
                        // echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
                        $data['tkjbpa'][] = ($data['tkjb'][$k] * $data['absensi'][$k]->total_potongan_absen)/100;
                        $data['tkjbhd'][] = ($data['tkjb'][$k] * $data['disiplin'][$k]->persentase)/100;
                        $data['tkjd'][] = $data['tkjb'][$k] - ($data['tkjbpa'][$k] + $data['tkjbhd'][$k]);
                        

                    }

                    /*return view('report.2back',compact('data',$data));*/
                    $pdf = PDF::loadView('report.invoice',compact('data',$data));
                    return $pdf->setPaper(array(0,0,612.00,936.00), 'potrait')->stream('report.pdf');
                }else if($request->type == "1"){
                    $data = [];
                    $data['pejabat_pembuat_komitmen'] = $request->pejabat_pembuat_komitmen;
                    $data['bendahara'] = $request->bendahara;
                    $data['belanja_pegawai'] = $request->belanja_pegawai;
                    $data['unit_id'] = $request->unit_id;
                    $data['grade_semua'] = Grade::orderBy('grade','ASC')->get();
                    $data['bulan'] = $request->bulan;
                    $data['tahun'] = $request->tahun;
                    $users = User::where('unit_id',$request->unit_id)->where('nip','!=','admin')->where('nip','!=','123')->get();

                    foreach ($users as $k => $v) {
                        $data['pegawai'][] = $v;
                        $data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        // 
                        $data['unit'][] = Unit::where('id', $v->unit_id)->first();
                        //Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
                        $data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
                        $data['grade'][] = Grade::where('id', $v->kelas_jabatan)->first();

                        //Potongan Absesi
                        $data['absensi'][] = PotonganAbsensi::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        //Potongan Disiplin
                        $data['disiplin'][] = PotonganDisiplin::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();

                        //echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
                        //echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
                        $data['tkjb'][] = ($data['grade'][$k]->tunjangan_kinerja * $data['dataKinerja'][$k]->persentase)/100;

                        //Tunjangan Kinerja Yang diterima
                        // echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
                        // echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
                        $data['tkjbpa'][] = ($data['tkjb'][$k] * $data['absensi'][$k]->total_potongan_absen)/100;
                        $data['tkjbhd'][] = ($data['tkjb'][$k] * $data['disiplin'][$k]->persentase)/100;
                        $data['tkjd'][] = $data['tkjb'][$k] - ($data['tkjbpa'][$k] + $data['tkjbhd'][$k]);
                        

                    }

                    /*return view('report.2back',compact('data',$data));*/
                    $pdf = PDF::loadView('report.perGolonganJabatan',compact('data',$data));
                    return $pdf->setPaper(array(0,0,612.00,936.00), 'potrait')->stream('report.pdf');
                }else if($request->type == "2"){
                    $data = [];
                    $data['pejabat_pembuat_komitmen'] = $request->pejabat_pembuat_komitmen;
                    $data['bendahara'] = $request->bendahara;
                    $data['belanja_pegawai'] = $request->belanja_pegawai;
                    $data['unit_id'] = $request->unit_id;
                    $data['grade_semua'] = Grade::orderBy('grade','ASC')->get();
                    $data['bulan'] = $request->bulan;
                    $data['tahun'] = $request->tahun;
                    $users = User::where('unit_id',$request->unit_id)->where('nip','!=','admin')->where('nip','!=','123')->get();

                    foreach ($users as $k => $v) {
                        $data['pegawai'][] = $v;
                        $data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        // 
                        $data['unit'][] = Unit::where('id', $v->unit_id)->first();
                        //Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
                        $data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
                        $data['grade'][] = Grade::where('id', $v->kelas_jabatan)->first();

                        //Potongan Absesi
                        $data['absensi'][] = PotonganAbsensi::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        //Potongan Disiplin
                        $data['disiplin'][] = PotonganDisiplin::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();

                        //echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
                        //echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
                        $data['tkjb'][] = ($data['grade'][$k]->tunjangan_kinerja * $data['dataKinerja'][$k]->persentase)/100;

                        //Tunjangan Kinerja Yang diterima
                        // echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
                        // echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
                        $data['tkjbpa'][] = ($data['tkjb'][$k] * $data['absensi'][$k]->total_potongan_absen)/100;
                        $data['tkjbhd'][] = ($data['tkjb'][$k] * $data['disiplin'][$k]->persentase)/100;
                        $data['tkjd'][] = $data['tkjb'][$k] - ($data['tkjbpa'][$k] + $data['tkjbhd'][$k]);
                        

                    }

                    /*return view('report.2back',compact('data',$data));*/
                $pdf = PDF::loadView('report.realisasi',compact('data',$data));
                    return $pdf->setPaper(array(0,0,612.00,936.00), 'potrait')->stream('report.pdf');
                }else if($request->type == "5"){
                    $data = [];
                    $data['pejabat_pembuat_komitmen'] = $request->pejabat_pembuat_komitmen;
                    $data['bendahara'] = $request->bendahara;
                    $data['belanja_pegawai'] = $request->belanja_pegawai;
                    $data['unit_id'] = $request->unit_id;
                    $data['grade_semua'] = Grade::orderBy('grade','ASC')->get();
                    $data['bulan'] = $request->bulan;
                    $data['tahun'] = $request->tahun;
                    $users = User::where('unit_id',$request->unit_id)->where('nip','!=','admin')->where('nip','!=','123')->get();

                    foreach ($users as $k => $v) {
                        $data['pegawai'][] = $v;
                        $data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        // 
                        $data['unit'][] = Unit::where('id', $v->unit_id)->first();
                        //Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
                        $data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
                        $data['grade'][] = Grade::where('id', $v->kelas_jabatan)->first();

                        //Potongan Absesi
                        $data['absensi'][] = PotonganAbsensi::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();
                        //Potongan Disiplin
                        $data['disiplin'][] = PotonganDisiplin::where('pegawai_id', $v->id)
                                                    ->where('bulan', $request->bulan)
                                                    ->where('tahun', $request->tahun)->first();

                        //echo $v->name . ':<br> Besar Tunjanagn = ' . $grade->tunjangan_kinerja . '<br>';
                        //echo "Tunjangan Kinerja Bulanan = " . ($grade->tunjangan_kinerja * $dataKinerja->persentase)/100 . "<br>";
                        $data['tkjb'][] = ($data['grade'][$k]->tunjangan_kinerja * $data['dataKinerja'][$k]->persentase)/100;

                        //Tunjangan Kinerja Yang diterima
                        // echo "Potongan Absensi : ". (($tkjb * $absensi->total_potongan_absen)/100). '<br>';
                        // echo "Potongan Disiplin : ". (($tkjb * $disiplin->persentase)/100). '<br>';
                        $data['tkjbpa'][] = ($data['tkjb'][$k] * $data['absensi'][$k]->total_potongan_absen)/100;
                        $data['tkjbhd'][] = ($data['tkjb'][$k] * $data['disiplin'][$k]->persentase)/100;
                        $data['tkjd'][] = $data['tkjb'][$k] - ($data['tkjbpa'][$k] + $data['tkjbhd'][$k]);
                        

                    }

                    /*return view('report.2back',compact('data',$data));*/
                $pdf = PDF::loadView('report.rekap',compact('data',$data));
                    return $pdf->setPaper(array(0,0,612.00,936.00), 'landscape')->stream('report.pdf');
                }
            }else{
                //return Redirect::to('export')->with('error', 'Data Tukin belum tersedia untuk bulan ' . $request->bulan . ' tahun '. $request->tahun .'.');
            }
        }else{
            return Redirect::to('export')->with('error', 'Tidak ada pegawai di unit kerja ini.');
        }
    }
}
