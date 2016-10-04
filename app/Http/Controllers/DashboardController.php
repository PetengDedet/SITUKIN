<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    //

    public function index()
    {
    	return view('admin.dashboard');
    }

    public function listData()
    {
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
