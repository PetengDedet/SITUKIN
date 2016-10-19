<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Unit;
use App\PotonganAbsensi;
use App\PotonganDisiplin;
use App\KinerjaBulanan;
use Redirect;
use Sentinel;
use DB;

class RekapController extends Controller
{
    //
    public function rekapdata(Request $request)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	return view('admin.rekapdata.list')->with('request',$request);
        }
    }

    public function datapotonganabsensi(Request $request){
        $PotonganAbsensi = PotonganAbsensi::where('pegawai_id','=',$request->pegawai_id)->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->get();

        return response()->json(['PotonganAbsensi' => $PotonganAbsensi]);
    }

    public function tambahpotonganabsen(Request $request){
        $check = PotonganAbsensi::where('pegawai_id','=',$request->pegawai_id)->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->count();

        
        if($check > 0){
            $data = PotonganAbsensi::where('pegawai_id','=',$request->pegawai_id)->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->first();
            $data->pegawai_id = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->tahun = $request->tahun;
            $data->tl1   = $request->tl1;
            $data->tl2   = $request->tl2;
            $data->tl3   = $request->tl3;
            $data->tl4   = $request->tl4;
            $data->psw1  = $request->psw1;
            $data->psw2  = $request->psw2;
            $data->psw3  = $request->psw3;
            $data->psw4  = $request->psw4;
            $data->cuti_tahunan  = $request->cuti_tahunan;
            $data->cuti_alasan_penting  = $request->cuti_alasan_penting;
            $data->cuti_sakit_tidak_rawat_inap  = $request->cuti_sakit_tidak_rawat_inap;
            $data->cuti_sakit_rawat_inap  = $request->cuti_sakit_rawat_inap;
            $data->cuti_sakit_rawat_jalan  = $request->cuti_sakit_rawat_jalan;
            $data->cuti_gugur_kandungan  = $request->cuti_gugur_kandungan;
            $data->cuti_bersalin  = $request->cuti_bersalin;
            $data->cuti_besar  = $request->cuti_besar;
            $data->cuti_luar_tanggungan_negara  = $request->cuti_luar_tanggungan_negara;
            $data->cuti_alpha  = $request->cuti_alpha;
            $data->cuti_ijin  = $request->cuti_ijin;
            $data->cuti_dinas_luar  = $request->cuti_dinas_luar;
            $data->cuti_tugas_belajar  = $request->cuti_tugas_belajar;
            $data->bebas_tugas  = $request->bebas_tugas;
            $data->total_potongan_absen = $request->total_potongan_absen;
            $data->update();
        }else{
            $data = new PotonganAbsensi();
            $data->pegawai_id = $request->pegawai_id;
            $data->bulan = $request->bulan;
            $data->tahun = $request->tahun;
            $data->tl1   = $request->tl1;
            $data->tl2   = $request->tl2;
            $data->tl3   = $request->tl3;
            $data->tl4   = $request->tl4;
            $data->psw1  = $request->psw1;
            $data->psw2  = $request->psw2;
            $data->psw3  = $request->psw3;
            $data->psw4  = $request->psw4;
            $data->cuti_tahunan  = $request->cuti_tahunan;
            $data->cuti_alasan_penting  = $request->cuti_alasan_penting;
            $data->cuti_sakit_tidak_rawat_inap  = $request->cuti_sakit_tidak_rawat_inap;
            $data->cuti_sakit_rawat_inap  = $request->cuti_sakit_rawat_inap;
            $data->cuti_sakit_rawat_jalan  = $request->cuti_sakit_rawat_jalan;
            $data->cuti_gugur_kandungan  = $request->cuti_gugur_kandungan;
            $data->cuti_bersalin  = $request->cuti_bersalin;
            $data->cuti_besar  = $request->cuti_besar;
            $data->cuti_luar_tanggungan_negara  = $request->cuti_luar_tanggungan_negara;
            $data->cuti_alpha  = $request->cuti_alpha;
            $data->cuti_ijin  = $request->cuti_ijin;
            $data->cuti_dinas_luar  = $request->cuti_dinas_luar;
            $data->cuti_tugas_belajar  = $request->cuti_tugas_belajar;
            $data->bebas_tugas  = $request->bebas_tugas;
            $data->total_potongan_absen = $request->total_potongan_absen;
            $data->save();
        }
    }

    public function simpanrekapdata(Request $request){
        for($i = 0 ; $i < count($request->pegawai_id) ; $i++){
            
            if($request->dari == "protakel"){
                $checkKinerja = KinerjaBulanan::where('pegawai_id','=',$request->pegawai_id[$i])->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->count();
                if($checkKinerja > 0){
                    $dataKinerja = KinerjaBulanan::where('pegawai_id','=',$request->pegawai_id[$i])->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->first();
                    $dataKinerja->pegawai_id = $request->pegawai_id[$i];
                    $dataKinerja->bulan = $request->bulan;
                    $dataKinerja->tahun = $request->tahun;
                    $dataKinerja->persentase = $request->kinerja_bulanan[$i];
                    $dataKinerja->update();
                }else{
                    $dataKinerja = new KinerjaBulanan();
                    $dataKinerja->pegawai_id = $request->pegawai_id[$i];
                    $dataKinerja->bulan = $request->bulan;
                    $dataKinerja->tahun = $request->tahun;
                    $dataKinerja->persentase = $request->kinerja_bulanan[$i];
                    $dataKinerja->save();
                }
            }
            
            if($request->from == "sdm"){
                $checkDisiplin = PotonganDisiplin::where('pegawai_id','=',$request->pegawai_id[$i])->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->count();
                if($checkDisiplin > 0){
                    $dataDisiplin = PotonganDisiplin::where('pegawai_id','=',$request->pegawai_id[$i])->where('bulan','=',$request->bulan)->where('tahun','=',$request->tahun)->first();
                    $dataDisiplin->pegawai_id = $request->pegawai_id[$i];
                    $dataDisiplin->bulan = $request->bulan;
                    $dataDisiplin->tahun = $request->tahun;
                    $dataDisiplin->persentase = $request->potongan_disiplin[$i];
                    $dataDisiplin->update();
                }else{
                    $dataDisiplin = new PotonganDisiplin();
                    $dataDisiplin->pegawai_id = $request->pegawai_id[$i];
                    $dataDisiplin->bulan = $request->bulan;
                    $dataDisiplin->tahun = $request->tahun;
                    $dataDisiplin->persentase = $request->potongan_disiplin[$i];
                    $dataDisiplin->save();
                }
            }
        }

        return Redirect::route('rekapdata')->with('success', 'Rekap data berhasil disimpan');
    }


    /*public function update(){
    	$data = DB::table('table 19')->get();

    	foreach($data as $datas){
            $idBaru = $datas->id + 430;
			DB::table('table 19')->where('id','=',$datas->id)->update(['id'=>$idBaru]);
    	}
    }*/
}
