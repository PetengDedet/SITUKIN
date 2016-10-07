<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Unit;
use Redirect;
use Sentinel;

class UnitController extends Controller
{
    //
    public function index()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	$unit = Unit::paginate(10);
        	return view('admin.unit.index', compact('unit', $unit));
        }
    }

    public function store(Request $r)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	$this->validate($r, [
        		'nama_unit' => 'required|max:255'
        	]);

        	$unit = new Unit();
        	$unit->nama_unit = $r->nama_unit;
        	$unit->save();

        	return redirect()->back();
        }
    }

    public function show($id)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $unit = Unit::findOrFail($id);
            return view('admin.unit.single',compact('unit',$unit));
        }
    }

    public function edit($id)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $unit = Unit::findOrFail($id);
            return view('admin.unit.edit',compact('unit',$unit));
        }
    }

    public function update(Request $r)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $this->validate($r, [
                'nama_unit' => 'required|max:255'
            ]);

            $unit = Unit::findOrFail($r->id);
            $unit->nama_unit = $r->nama_unit;
            $unit->save();

            return redirect(url('unit'));
        }
    }
}
