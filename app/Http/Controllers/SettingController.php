<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

use Sentinel;
use Hash;
use User;

class SettingController extends Controller
{
    //

    public function index()
    {
    	
    	return view('admin.setting');
    }

    public function savePassword(Request $r)
    {
    	$this->validate($r, [
    		'password' => 'required|confirmed'
    	]);

    	$user = \App\User::find(Sentinel::getUser()->id);
    	$user->password = Hash::make($r->password);
    	$user->save();
    	// dd($user);
    	Session::flash('success', 'Berhasil disimpan'); 
        Session::flash('alert-class', 'alert-success');
        return redirect('setting');
    }
}
