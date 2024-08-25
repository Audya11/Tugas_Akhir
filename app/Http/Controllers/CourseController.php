<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('school.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Course::create($request->all());
        return redirect('/school/dashboard/course')->with('success', 'Mata Pelajaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findorfail($id);

        $course->update($request->all());
        return redirect('/school/dashboard/course')->with('success', 'Mata Pelajaran Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findorfail($id);
        $course->delete();
        return redirect('/school/dashboard/course')->with('success', 'Mata Pelajaran Berhasil Dihapus');
    }
}
