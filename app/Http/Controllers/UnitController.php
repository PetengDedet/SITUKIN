<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Unit;

class UnitController extends Controller
{
    //
    public function index()
    {
    	$unit = Unit::paginate(10);
    	return view('admin.unit.index', compact('unit', $unit));
    }
}
