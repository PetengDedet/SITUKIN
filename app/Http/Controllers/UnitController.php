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

    public function store(Request $r)
    {
    	$this->validate($r, [
    		'nama_unit' => 'required|max:255'
    	]);

    	$unit = new Unit();
    	$unit->nama_unit = $r->nama_unit;
    	$unit->save();

    	return redirect()->back();
    }

    public function show($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.unit.single',compact('unit',$unit));
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.unit.edit',compact('unit',$unit));
    }

    public function update(Request $r)
    {
        $this->validate($r, [
            'nama_unit' => 'required|max:255'
        ]);

        $unit = Unit::findOrFail($r->id);
        $unit->nama_unit = $r->nama_unit;
        $unit->save();

        return redirect(url('admin/unit'));
    }
}
