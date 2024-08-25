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
        $subclasses = Subclass::with('class')->get();
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
        Subclass::create($request->all());
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
