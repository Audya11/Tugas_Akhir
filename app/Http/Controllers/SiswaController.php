<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // $siswas = Siswa::paginate(2);
        $siswas = Siswa::with('sekolah')->paginate(5);
        // dd($siswas);
        return view('admin.daftar_siswa.index',[
            'siswas' => $siswas
        ]);
    }

    public function create()
    {
        $sekolahs = Sekolah::all();
        return view('admin.daftar_siswa.create',[
            'sekolahs' => $sekolahs
        ]);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|numeric|unique:siswas,nis',
            'kelas' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string',
            'sekolah_id' => 'required|exists:sekolahs,id',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:siswas,email',
            'no_telp' => 'required|numeric',
        ]);

        // Encrypt the password before saving

        // Create a new Siswa record
        Siswa::create($validateData);
        $sekolah = Sekolah::find($validateData['sekolah_id']);
       

        // Redirect to the daftar_siswa route with a success message
        return redirect(route('siswa.all'))->with('success', 'Data Sekolah Berhasil Ditambahkan');
    }

    public function edit ($id)
    {
        $sekolahs = Sekolah::all();
        $siswa = Siswa::find($id);
        return view('admin.daftar_siswa.edit', [
            'sekolahs' => $sekolahs,
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findorfail($id);
        $siswa->update($request->all());
        return redirect('/daftar_siswa')->with('success', 'Data Sekolah Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findorfail($id);
        $siswa->delete();
        return redirect('/daftar_siswa')->with('success', 'Data Sekolah Berhasil Dihapus');
    }

    public function detail ($id)
    {
        $siswa = Siswa::find($id);
        $sekolahs = Sekolah::all();
        return view('admin.daftar_siswa.detail', [
            'siswa' => $siswa,
            'sekolahs' => $sekolahs
        ]);
    }
}

    

