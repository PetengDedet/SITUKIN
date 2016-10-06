<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Jabatan;
use App\Grade;
use App\Unit;

class JabatanController extends Controller
{
    //
    public function index()
    {
    	$jabatan = Jabatan::paginate(10);
    	return view('admin.jabatan.index')->with(['jabatan' => $jabatan]);
    }

    public function create()
    {
        $unit = Unit::all();
        $grade = Grade::all();

        return view('admin.jabatan.create')->with(['unit' => $unit, 'grade' => $grade]);       
    }

    public function store(Request $r)
    {
    	$this->validate($r, [
    		'unit' => 'required',
    		'nama_jabatan' => 'required|max:255',
            'kelas_jabatan' => 'required'

    	]);

    	$jabatan = new Jabatan();
    	$jabatan->unit_id = $r->unit;
    	$jabatan->kelas_jabatan = $r->kelas_jabatan;
    	$jabatan->nama_jabatan = $r->nama_jabatan;
    	$jabatan->save();

    	return redirect('admin/jabatan');
    }

    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('admin.jabatan.single',compact('jabatan',$jabatan));
    }

    public function edit($id)
    {

        $jabatan = Jabatan::findOrFail($id);
        $unit = Unit::all();
        $grade = Grade::all();

        return view('admin.jabatan.edit')->with(['jabatan' => $jabatan, 'unit' => $unit, 'grade' => $grade]);
    }

    public function update(Request $r)
    {
        $this->validate($r, [
            'unit' => 'required',
            'nama_jabatan' => 'required|max:255',
            'kelas_jabatan' => 'required'

        ]);

        $jabatan = Jabatan::findOrFail($r->id);
        $jabatan->unit_id = $r->unit;
        $jabatan->kelas_jabatan = $r->kelas_jabatan;
        $jabatan->nama_jabatan = $r->nama_jabatan;
        $jabatan->save();

        return redirect('admin/jabatan');
    }
}
