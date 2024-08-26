<?php

namespace App\Http\Controllers;

use App\Models\Subclass;
use App\Models\Classes;
use Illuminate\Http\Request;

class SubclassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school_id  = auth()->user()->school()->first()->id;
        $subclasses = Subclass::with('class')->where('school_id', $school_id)->get();
        $classes    = Classes::all();

        return view('school.subclass.index', compact('subclasses', 'classes'));
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
        Subclass::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'school_id' => $school_id
        ]);
        return redirect('/school/dashboard/subclass')->with('success', 'Sub Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subclass $subclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subclass $subclass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subclass = Subclass::findorfail($id);

        $subclass->update($request->all());
        return redirect('/school/dashboard/subclass')->with('success', 'Sub Kelas Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subclass = Subclass::findorfail($id);
        $subclass->delete();

        return redirect('/school/dashboard/subclass')->with('success', 'Sub Kelas Berhasil Dihapus');
    }
}
