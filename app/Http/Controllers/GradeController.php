<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Grade;

class GradeController extends Controller
{
    //
    public function index()
    {
    	$grade = Grade::all();
    	return view('admin.grade.index', compact('grade', $grade));
    }

    public function store(Request $r)
    {
    	$this->validate($r, [
    		'grade' => 'required',
    		'tunjangan_kinerja' => 'required',
    		'dasar_hukum' => 'max:255'
    	]);

    	$grade = new Grade();
    	$grade->grade = $r->grade;
    	$grade->tunjangan_kinerja = $r->tunjangan_kinerja;
    	$grade->dasar_hukum = $r->dasar_hukum;
    	$grade->save();

    	return redirect()->back();
    }

    public function show($id)
    {
        $grade = Grade::findOrFail($id);
        return json_encode($grade);
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        return view('admin.grade.edit',compact('grade',$grade));
    }

    public function update(Request $r)
    {
        $this->validate($r, [
    		'grade' => 'required',
    		'tunjangan_kinerja' => 'required',
    		'dasar_hukum' => 'max:255'
    	]);

    	$grade = Grade::findOrFail($r->grade);
    	$grade->grade = $r->grade;
    	$grade->tunjangan_kinerja = $r->tunjangan_kinerja;
    	$grade->dasar_hukum = $r->dasar_hukum;
    	$grade->save();

        return redirect(url('admin/grade'));
    }
}
