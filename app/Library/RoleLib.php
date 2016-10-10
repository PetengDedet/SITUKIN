<?php
namespace App\Library;

use Illuminate\Support\Facades\Redirect;
use \Session;
use \DB;
use Illuminate\Support\Facades\Request;
use Auth;

Class RoleLib 
{
	public static function limitThis($role_id, $user_id, $redirect_to = null) {

		$cekAdmin = DB::table('role_user')->where('user_id', $user_id)->where('role_id','1')->count();
		$cekRole = DB::table('role_user')->where('user_id', $user_id)->where('role_id',$role_id)->count();;

		$total = $cekAdmin + $cekRole;

		if ($total > 0) {
			return true;
		}

		return false;
	}

	public static function hideThis($role_id, $user_id, $html = null) {

		$cekAdmin = DB::table('role_user')->where('user_id', $user_id)->where('role_id','1')->count();
		$cekRole = DB::table('role_user')->where('user_id', $user_id)->where('role_id',$role_id)->count();;

		$total = $cekAdmin + $cekRole;

		if ($total > 0) {
			return $html;
		}else{
			return '';
		}

		return $html;
	}
}