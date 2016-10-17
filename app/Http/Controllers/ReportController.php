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

use App\Library\RoleLib;
use Sentinel;

class ReportController extends Controller
{
    //
    public function export($unit, $bulan, $tahun)
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
        	$data['pegawai'][] = $v;
        	$data['dataKinerja'][] = KinerjaBulanan::where('pegawai_id', $v->id)
        								->where('bulan', $bulan)
        								->where('tahun', $tahun)->first();
        	//Ambil Jabatan, kelas jabatan, dan besarnya tunjangan
        	$data['jabatan'][] = Jabatan::where('id', $v->jabatan_id)->first();
        	$data['grade'][] = Grade::where('id', $data['jabatan'][$k]->kelas_jabatan)->first();

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
        $pdf = PDF::loadView('report.2back',compact('data',$data));
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
        	$grade = Grade::where('id', $jabatan->kelas_jabatan)->first();

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
        return view('report.index');
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
}
