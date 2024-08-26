<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school_id = auth()->user()->school()->first()->id;
        $classes   = Classes::where('school_id', $school_id)->get();
        return view('school.class.index', compact('classes'));
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
        $school_id = auth()->user()->school()->first()->id;

        Classes::create([
            'name' => $request->name,
            'school_id' => $school_id
        ]);
        return redirect('/school/dashboard/class')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $classes = Classes::findorfail($id);
        $classes->update($request->all());
        return redirect('/school/dashboard/class')->with('success', 'Kelas Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classes = Classes::findorfail($id);
        $classes->delete();
        return redirect('/school/dashboard/class')->with('success', 'Kelas Berhasil Dihapus');
    }
}
