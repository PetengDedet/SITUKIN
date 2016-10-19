<?php
namespace App\Library;

use App\User;

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

		$gajiSetahun = $getDataUser->gjpokok * 12;
		$tukinSetahun = $tukin * 12;

		if($getDataUser->gjpokok + $tukin < 10000000){
			$hasilHitungJabatanDanIuranPensiun = (($getDataUser->gjpokok + $tukin) * 0.5) + ($getDataUser->gjpokok * 0.475);

			if($hasilHitungJabatanDanIuranPensiun > 500000){
				$biayaJabatanDanIuranPensiun = 500000 * 12;
			}else{
				$biayaJabatanDanIuranPensiun = $hasilHitungJabatanDanIuranPensiun * 12;
			}
		}else{
			$biayaJabatanDanIuranPensiun = 500000 * 12;
		}

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
		if($sisadariLimaPersen < 200000000){
			$pajakLimaBelasPersen = ($sisadariLimaPersen * 0.15) / 12; 
		}else if($sisadariLimaPersen > 200000000){
			$pajakLimaBelasPersen = (200000000 * 0.1) / 12; 
		}else{
			$pajakLimaBelasPersen = 0; 
		}

		if($sisadariLimaPersen > 250000000){
			$pajakDuaLimaPersen = ($sisadariLimaPersen - 250000000) * 0.25 / 12; 
		}else{
			$pajakDuaLimaPersen = 0; 
		}

		$total = $pajaklimapersen + $pajakLimaBelasPersen + $pajakDuaLimaPersen;
		return $total;
	}

	public static function Pembulatan($nominal){
		$x = $nominal;
		$x = 1000 * floor($x/1000);
		return $x;
	}
}