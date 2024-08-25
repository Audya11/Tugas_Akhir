<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $sekolah = Auth::user()->school()->first();
        return view('school.profil.index', compact('sekolah'));
    }

    public function change_password(Request $request)
    {
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/school/profile')->with('success', 'Password Berhasil Diperbarui');
    }

}
