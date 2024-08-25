<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('school.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sch_id = auth()->user()->school()->first()->id;

        Teacher::create([
            'sekolah_id' => $sch_id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
        ]);

        return redirect('/school/dashboard/teacher')->with('success', 'Data Guru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('/school/dashboard/teacher/detail', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('school.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return redirect('/school/dashboard/teacher')->with('success', 'Guru Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect('/school/dashboard/teacher')->with('success', 'Guru Berhasil Dihapus');
    }
}
