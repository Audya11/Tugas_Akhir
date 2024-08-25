<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Siswa;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Subclass;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function studentSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $siswas = Siswa::with('sekolah')->where('nama', 'LIKE', "%{$query}%")
                ->orWhere('nis', 'LIKE', "%{$query}%")
                ->orWhere('kelas', 'LIKE', "%{$query}%")
                ->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $siswas = Siswa::with('sekolah')->all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($siswas);
    }

    public function yearSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $academicYears = AcademicYear::where('year', 'LIKE', "%{$query}%")->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $academicYears = AcademicYear::all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($academicYears);
    }
    public function majorSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $majors = Major::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $majors = Major::all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($majors);
    }
    public function teacherSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $teachers = Teacher::with('school')->where('nama', 'LIKE', "%{$query}%")
                ->orWhere('nip', 'LIKE', "%{$query}%")
                ->orWhere('kelas', 'LIKE', "%{$query}%")
                ->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $teachers = Teacher::with('school')->all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($teachers);
    }
    public function kelasSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $clasess = Classes::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $clasess = Classes::all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($clasess);
    }
    public function subClassSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $subclasses = Subclass::with('class')->where('name', 'LIKE', "%{$query}%")->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $subclasses = Subclass::with('class')->all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($subclasses);
    }
    public function courseSearch(Request $request)
    {
        $query = $request->input('query');

        // Pastikan query inputan tidak kosong sebelum melakukan pencarian
        if ($query) {
            $courses = Course::where('courses_title', 'LIKE', "%{$query}%")
                ->orWhere('course_code', 'LIKE', "%{$query}%")
                ->get();
        } else {
            // Jika query kosong, kembalikan semua data atau data kosong
            $courses = Course::all();
        }

        // Mengembalikan hasil sebagai JSON
        return response()->json($courses);
    }
}
