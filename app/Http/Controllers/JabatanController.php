<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jabatan;
use App\Grade;
use App\Unit;
use Redirect;
use Sentinel;
use PDF;

class JabatanController extends Controller
{
    //
    public function index()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
        	$jabatan = Jabatan::paginate(10);
        	return view('admin.jabatan.index')->with(['jabatan' => $jabatan]);
        }
    }

    public function create()
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $unit = Unit::all();
            $grade = Grade::all();

            return view('admin.jabatan.create')->with(['unit' => $unit, 'grade' => $grade]);       
        }
    }

    public function store(Request $r)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
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

        	return redirect('jabatan');
        }
    }

    public function show($id)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $jabatan = Jabatan::findOrFail($id);
            return view('admin.jabatan.single',compact('jabatan',$jabatan));
        }
    }

    public function edit($id)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
            $jabatan = Jabatan::findOrFail($id);
            $unit = Unit::all();
            $grade = Grade::all();

            return view('admin.jabatan.edit')->with(['jabatan' => $jabatan, 'unit' => $unit, 'grade' => $grade]);
        }
    }

    public function update(Request $r)
    {
        if(!Sentinel::check()){
            return Redirect::route('login')->with('error', 'Silahkan melakukan login terlebih dahulu');
        }else{
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

            return redirect('jabatan');
        }
    }

    public function jabatanjson(Request $request){
        $count = Jabatan::where('unit_id','=',$request->unit_id)->count();
        if($count > 0){
           $jabatan = Jabatan::where('unit_id','=',$request->unit_id)->orWhere('unit_id','=','999')->get(); 
           return response()->json(['Jabatan' => $jabatan]);
        }
    }

    public function tesPdf()
    {
        $pdf = PDF::loadView('report.1');
        return $pdf->setPaper('legal', 'landscape')->stream('invoice.pdf');
    }
}
