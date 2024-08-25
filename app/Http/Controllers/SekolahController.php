<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekolah;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sekolahs = Sekolah::paginate(5);
        return view('admin.daftar_sekolah.index', [
            'sekolahs' => $sekolahs
        ]);
    }

    public function getData()
    {
        $schools = Sekolah::select(['nama_sekolah', 'paket', 'status', 'tanggal_kadaluarsa', 'alamat'])->get();
        // dd($schools);

        return DataTables::of($schools)
            ->addColumn('action', function ($school) {
                return '<a href="#edit-' . $school->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sekolahs = Sekolah::all();
        return view('admin.daftar_sekolah.create', [
            'sekolahs' => $sekolahs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validateData = $request->validate([
            'type' => 'required',
            'nama_sekolah' => 'required|string|max:255',
            'paket' => 'required',
            'status' => 'required',
            'tanggal_kadaluarsa' => 'required|date',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Buat akun user untuk sekolah
        $user = User::create([
            'name' => $request->nama_sekolah,
            'email' => $request->email,
            'password' => $request->password, // Ganti dengan password yang lebih aman
            'role' => 'school',
        ]);

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User tidak dapat dibuat.']);
        }

        // Buat sekolah dan hubungkan dengan user sekolah
        $sekolah = Sekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'type' => $request->type,
            'paket' => $request->paket,
            'status' => $request->status,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat,
        ]);

        if (!$sekolah) {
            return redirect()->back()->withErrors(['message' => 'Sekolah tidak dapat dibuat.']);
        }

        // Hubungkan sekolah dengan user
        $user->school()->attach($sekolah->id);

        return redirect('/')->with('success', 'Sekolah berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $sekolah = Sekolah::find($id);

        // dd($sekolah);
        return view('admin.daftar_sekolah.edit', [
            'sekolah' => $sekolah
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        // Find the existing school record by its ID
        $sekolah = Sekolah::findorfail($id);

        // Update the school record with the validated data
        $sekolah->update($request->all());

        // Redirect back to the index route with a success message
        return redirect('/dashboard/daftar_sekolah')->with('success', 'Data Sekolah Berhasil Diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::where('id', $id)->first();
        $sekolah->delete();
        return redirect('/dashboard/daftar_sekolah')->with('success', 'Data Sekolah Berhasil Dihapus');
    }

    public function detail($id)
    {
        $sekolah = Sekolah::find($id);
        return view('admin.daftar_sekolah.detail', [
            'sekolah' => $sekolah
        ]);
    }

    public function v_changePassword()
    {
        $users = User::all();

        return view('admin.change-password.index', compact('users'));
    }
    public function changePassword(Request $request)
    {

    }
}
