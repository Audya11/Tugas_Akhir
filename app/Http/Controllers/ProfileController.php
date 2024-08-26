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

        // dd($request->all());
        $user = Auth::user();

        // Verifikasi password saat ini
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        // Cek apakah password baru berbeda dengan password lama
        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password lama.']);
        }

        // Update password pengguna
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/school/profile')->with('success', 'Password Berhasil Diperbarui');
    }

}
