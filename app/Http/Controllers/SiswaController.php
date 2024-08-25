<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Subclass;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // $siswas = Siswa::paginate(2);
        $siswas = Siswa::with('sekolah')->paginate(5);
        // dd($siswas);

        return view('admin.daftar_siswa.index', [
            'siswas' => $siswas
        ]);
    }

    public function create()
    {
        $sekolahs = Sekolah::all();
        return view('admin.daftar_siswa.create', [
            'sekolahs' => $sekolahs
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|numeric|unique:siswas,nis',
            'kelas' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string',
            'sekolah_id' => 'required|exists:sekolahs,id',
            'no_telp' => 'required|numeric',
            'average_score' => 'required',
        ]);

        // dd($validateData);

        // Encrypt the password before saving

        // Create a new Siswa record
        Siswa::create($validateData);
        $sekolah = Sekolah::find($validateData['sekolah_id']);


        // Redirect to the daftar_siswa route with a success message
        return redirect(route('siswa.all'))->with('success', 'Data Sekolah Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $sekolahs = Sekolah::all();
        $siswa    = Siswa::find($id);
        return view('admin.daftar_siswa.edit', [
            'sekolahs' => $sekolahs,
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findorfail($id);
        $siswa->update($request->all());
        return redirect('/dashboard/daftar_siswa')->with('success', 'Data Sekolah Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findorfail($id);
        $siswa->delete();
        return redirect('/dashboard/daftar_siswa')->with('success', 'Data Sekolah Berhasil Dihapus');
    }

    public function detail($id)
    {
        $siswa    = Siswa::find($id);
        $sekolahs = Sekolah::all();
        return view('admin.daftar_siswa.detail', [
            'siswa' => $siswa,
            'sekolahs' => $sekolahs
        ]);
    }

    public function schoolStudents()
    {
        $sch_id = auth()->user()->school()->first()->id;
        $siswas = Siswa::where('sekolah_id', $sch_id)->get();
        return view('school.student.index', compact('siswas'));
    }

    public function schoolStudentCreate()
    {

        $subclass = Subclass::with('class')->get();
        return view('school.student.create', compact('subclass'));
    }
    public function schoolStudentStore(Request $request)
    {
        $sch_id = auth()->user()->school()->first()->id;

        Siswa::create([
            'sekolah_id' => $sch_id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'average_score' => $request->average_score,

        ]);

        return redirect('/school/dashboard/student')->with('success', 'Data Siswa Berhasil Ditambahkan');
    }


    public function schoolStudentDetail($id)
    {
        $sch_id = auth()->user()->school()->first()->id;
        $siswa  = Siswa::where('sekolah_id', $sch_id)->find($id);
        return view('school.student.detail', compact('siswa'));
    }

    public function schoolStudentEdit($id)
    {
        $siswa = Siswa::find($id);
        return view('school.student.edit', compact('siswa'));
    }

    public function schoolStudentUpdate(Request $request, $id)
    {
        $student = Siswa::findorfail($id);
        $student->update($request->all());
        return redirect('/school/dashboard/student')->with('success', 'Data Siswa Berhasil Diperbarui');
    }

    public function schoolStudentDestroy($id)
    {
        $student = Siswa::findorfail($id);
        $student->delete();
        return redirect('/school/dashboard/student')->with('success', 'Data Siswa Berhasil Dihapus');
    }


}



