<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $sekolahs = Sekolah::paginate(5);
        return view('admin.daftar_sekolah.index',[
            'sekolahs' => $sekolahs
        ]);
    }

    public function getData(){
        $schools = Sekolah::select(['nama_sekolah', 'paket', 'status', 'tanggal_kadaluarsa', 'alamat'])->get();
        // dd($schools);

        return DataTables::of($schools)
            ->addColumn('action', function ($school) {
                return '<a href="#edit-'.$school->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $sekolahs = Sekolah::all();
        return view('admin.daftar_sekolah.create',[
            'sekolahs' => $sekolahs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'type' => 'required',
            'nama_sekolah' => 'required|string|max:255',
            'paket' => 'required',
            'status' => 'required',
            'tanggal_kadaluarsa' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required',
        ]);

        Sekolah::create($validateData);
        return redirect(route('sekolah.all'))->with('success', 'Data Sekolah Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $sekolah = Sekolah::find($id); 
        // dd($sekolah);
        return view('admin.daftar_sekolah.edit',[
            'sekolah' => $sekolah
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, $id)
    {

    
        // Find the existing school record by its ID
        $sekolah = Sekolah::findorfail($id);
    
        // Update the school record with the validated data
        $sekolah->update($request->all());
    
        // Redirect back to the index route with a success message
        return redirect('/daftar_sekolah')->with('success', 'Data Sekolah Berhasil Diperbarui');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $sekolah = Sekolah::where('id', $id)->first();
        $sekolah->delete();
        return redirect('/daftar_sekolah')->with('success', 'Data Sekolah Berhasil Dihapus');
    }

    public function detail ($id)
    {
        $sekolah = Sekolah::find($id);
        return view('admin.daftar_sekolah.detail',[
            'sekolah' => $sekolah
        ]);
    }
}
