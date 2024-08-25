<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::all();
        return view('school.major.index', compact('majors'));
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
        Major::create($request->all());
        return redirect('/school/dashboard/major')->with('success', 'Jurusan berhasil diperbarui');

    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $major = Major::findorfail($id);

        $major->update($request->all());

        return redirect('/school/dashboard/major')->with('success', 'Jurusan berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $major = Major::findorfail($id);
        $major->delete();

        return redirect('/school/dashboard/major')->with('success', 'Jurusan berhasil dihapus');
    }
}