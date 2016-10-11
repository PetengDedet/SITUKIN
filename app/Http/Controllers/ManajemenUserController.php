<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Library\RoleLib;
use Sentinel;

use App\User;
use App\Role;


class ManajemenUserController extends Controller
{
    //
    public function index()
    {
    	if(!RoleLib::limitThis(4, Sentinel::getUser()->id, $redirect_to = null)) {
        	abort(404);
        }

    	$dataPegawai = User::all();
    	$roles = Role::paginate(10);
    	
    	return view('admin.manajemen-user.index')->with([
    		'dataPegawai' => $dataPegawai,
    		'roles' => $roles
    	]);
    }

    public function getSelected($id)
    {
    	$user = User::find($id);
    	return json_encode($user);
    }

    function simpan(Request $r)
    {
    	if(!RoleLib::limitThis(4, Sentinel::getUser()->id, $redirect_to = null)) {
        	abort(404);
        }
        
    	$this->validate($r, [
    		'user_id' => 'required',
    		'role' => 'required|in:1,2,3,4'
    	]);

    	$check = Role::where('user_id', $r->user_id)->where('role_id', $r->role)->get()->count();
    	if ($check > 0) {
    		Session::flash('message', 'Sudah ada role yang sama untuk user ini'); 
	        Session::flash('alert-class', 'alert-warning');
	        return redirect('manajemen-user');
    	}

    	$role = new Role();
    	$role->user_id = $r->user_id;
    	$role->role_id = $r->role;
    	$role->save();

    	Session::flash('message', 'Berhasil disimpan'); 
        Session::flash('alert-class', 'alert-success');
        
        return redirect('manajemen-user');
    }

    public function hapus(Request $r)
    {
    	$role = Role::where('role_id', $r->role_id)->where('user_id', $r->user_id)->delete();
    	Session::flash('message', 'Berhasil dihapus'); 
        Session::flash('alert-class', 'alert-success');
        
        return redirect('manajemen-user');
    }
}
