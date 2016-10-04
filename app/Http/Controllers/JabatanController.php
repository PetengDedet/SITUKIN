<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Jabatan;

class JabatanController extends Controller
{
    //

    public function index()
    {
    	$jabatan = Jabatan::all();
    }
}
