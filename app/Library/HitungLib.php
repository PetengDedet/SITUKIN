<?php
namespace App\Library;

use App\User;
use App\Jabatan;
use App\Grade;
use App\KinerjaBulanan;
use App\PotonganAbsensi;
use App\PotonganDisiplin;

Class HitungLib 
{
	public static function PPHDuaSatu($tukin, $user_id) {

		$getDataUser = User::where('id',$user_id)->first();
		$kdkawin = $getDataUser->kdkawin;
		$penghasilanSetaunTidakKenaPajak = 0;

		if($kdkawin == 1000){
			$penghasilanSetaunTidakKenaPajak = 54000000;
		}else if($kdkawin == 1001){
			$penghasilanSetaunTidakKenaPajak = 58500000;
		}else if($kdkawin == 1002){
			$penghasilanSetaunTidakKenaPajak = 63000000;
		}else if($kdkawin == 1003){
			$penghasilanSetaunTidakKenaPajak = 67500000;
		}else if($kdkawin == 1100){
			$penghasilanSetaunTidakKenaPajak = 58500000;
		}else if($kdkawin == 1101){
			$penghasilanSetaunTidakKenaPajak = 63000000;
		}else if($kdkawin == 1102){
			$penghasilanSetaunTidakKenaPajak = 67500000;
		}else if($kdkawin == 1103){
			$penghasilanSetaunTidakKenaPajak = 72000000;
		}else if($kdkawin == 1200){
			$penghasilanSetaunTidakKenaPajak = 112500000;
		}else if($kdkawin == 1201){
			$penghasilanSetaunTidakKenaPajak = 117000000;
		}else if($kdkawin == 1202){
			$penghasilanSetaunTidakKenaPajak = 121500000;
		}else if($kdkawin == 1203){
			$penghasilanSetaunTidakKenaPajak = 126000000;
		}

		$gajiSetahun = $getDataUser->bersih * 12;
		$tukinSetahun = $tukin * 12;

		if(($getDataUser->bersih + $tukin) <= 10000000){
			$hasilHitungJabatan = ($getDataUser->bersih + $tukin) * 0.5;
		}else{
			$hasilHitungJabatan = 500000;
		}

		$biayaJabatanDanIuranPensiun  =  (($hasilHitungJabatan + ($getDataUser->bersih * 0.0475)) * 12);

		$PKPPertahun = (($gajiSetahun + $tukinSetahun) - $penghasilanSetaunTidakKenaPajak - $biayaJabatanDanIuranPensiun);
		//cek pajak 5%
		if($PKPPertahun < 50000000){
			$pajaklimapersen = (0.05 * $PKPPertahun) / 12;
		}else if($PKPPertahun > 50000000){
			$pajaklimapersen = (50000000 * 0.05) / 12;
		}else{
			$pajaklimapersen = 0; 
		}

		$sisadariLimaPersen = $PKPPertahun - 50000000;

		//cek pajak 15%
		if($sisadariLimaPersen > 0){
			if($sisadariLimaPersen < 200000000){
				$pajakLimaBelasPersen = ($sisadariLimaPersen * 0.15) / 12; 
			}else if($sisadariLimaPersen > 200000000){
				$pajakLimaBelasPersen = (200000000 * 0.1) / 12; 
			}else{
				$pajakLimaBelasPersen = 0; 
			}
		}else{
			$pajakLimaBelasPersen = 0; 
		}

		if($sisadariLimaPersen > 0){
			if($sisadariLimaPersen > 250000000){
				$pajakDuaLimaPersen = ($sisadariLimaPersen - 250000000) * 0.25 / 12; 
			}else{
				$pajakDuaLimaPersen = 0; 
			}
		}else{
			$pajakDuaLimaPersen = 0; 
		}
		

		$total = $pajaklimapersen + $pajakLimaBelasPersen + $pajakDuaLimaPersen;

		if($total < 0){
			$total = 0;
		}
		return $total;
	}

	public static function Pembulatan($nominal){
		$x = $nominal;
		$x = 1000 * floor($x/1000);
		return $x;
	}

	public static function HitungKinerjaBulanan($user_id, $bulan, $tahun){
		$dataUser = User::where('id',$user_id)->first();
		$dataKinerja = KinerjaBulanan::where('pegawai_id', $user_id)
	                                    ->where('bulan', $bulan)
	                                    ->where('tahun', $tahun)->first();
        $dataJabatan = Jabatan::where('id', $dataUser->jabatan_id)->first();
        $dataGrade = Grade::where('id', $dataJabatan->kelas_jabatan)->first();

        $dataPotonganAbsensi = PotonganAbsensi::where('pegawai_id', $user_id)
                                            ->where('bulan', $bulan)
                                            ->where('tahun', $tahun)->first();

		$dataPotonganDisiplin = PotonganDisiplin::where('pegawai_id', $user_id)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)->first();

		$tkjb = ($dataGrade->tunjangan_kinerja * $dataKinerja->persentase)/100;
		$tkjbpa = ($tkjb * $dataPotonganAbsensi->total_potongan_absen)/100;
		$tkjbhd = ($tkjb * $dataPotonganDisiplin->persentase)/100;
		$tkjd = $tkjb - ($tkjbpa + $tkjbhd);

		return $tkjd;
	}
}