<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicYears = AcademicYear::all();
        return view('school.academic-year.index', compact('academicYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        AcademicYear::create([
            'year' => $request->year,
            'status' => $request->status
        ]);

        return redirect('/school/dashboard/academic-year')->with('success', 'Data Akademik Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $academicYear = AcademicYear::findorfail($id);

        $academicYear->update($request->all());

        return redirect('/school/dashboard/academic-year')->with('success', 'Data Akademik Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $academicYear = AcademicYear::findorfail($id);
        $academicYear->delete();

        return redirect('/school/dashboard/academic-year')->with('success', 'Data Akademik Berhasil Dihapus');
    }


}
