<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use Redirect;
use Sentinel;

class DashboardController extends Controller
{
    //

    public function index()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $pegawai = User::all()->count();
            $unit = \App\Unit::all()->count();
            $jabatan = \App\Jabatan::all()->count();
            $grade = \App\Grade::all()->count();
        	return view('admin.dashboard')->with([
                'pegawai' => $pegawai,
                'unit' => $unit,
                'jabatan' => $jabatan,
                'grade' => $grade
            ]);
        }
    }

    public function listData()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $users = User::select(['id', 'name', 'email']);

            return Datatables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                })
                // ->editColumn('id', '{{$id}}')
                ->removeColumn('password')
                ->make(true);
        }
    }
}
