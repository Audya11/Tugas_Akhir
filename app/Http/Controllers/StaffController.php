<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::paginate(5);
        return view('admin.staff.index',[
            'staffs' => $staff
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = Staff::all();
        return view('admin.staff.create',[
            'staffs' => $staff
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string',
            'role' => 'required|string',
            'no_telp' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan'
        ]);

        if($request->hasFile('photo')){
            $validateData['photo'] = $request->file('photo')->store('photo', 'public');
        }

        Staff::create($validateData);
        return redirect(route('staff.all'))->with('success', 'Data Staff Berhasil Ditambahkan');
    }

 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        return view('admin.staff.edit', [
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->update($request->all());
        return redirect('/dashboard/staff')->with('success', 'Data Staff Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        // dd($);
        $staff = Staff::findorfail($id);
        $staff->delete();
        
        return redirect('/dashboard/staff')->with('success', 'Data Staff Berhasil Dihapus');
    }

    public function detail($id)
    {
        $staff = Staff::find($id);
        return view('admin.staff.detail', [
            'staff' => $staff
        ]);
    }
}
