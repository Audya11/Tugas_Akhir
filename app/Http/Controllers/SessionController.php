<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Sekolah;

class SessionController extends Controller
{
    function index()
    {
        return view('sesi.index');
    }

    function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'

        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/sesi');
    }

    function schoolLogin()
    {
        return view('school.login.index');
    }

    public function onSchoolLogin(Request $request)
    {

        // Validasi input
        $credentials = $request->only('email', 'password');
        // dd($credentials);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // dd($user); // Mengambil sekolah pertama yang terkait
            if ($user->role == 'super_admin') {
                return redirect()->route('sekolah.all');
            } elseif ($user->role == 'school') {

                $sekolah = $user->school->first();
                if (!$sekolah) {
                    return redirect()->back()->withErrors(['message' => 'Sekolah tidak ditemukan untuk pengguna ini.']);
                }
                return redirect()->route('dashboard.show');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['message' => 'Role pengguna tidak valid.']);
            }
        }

        return redirect()->back()->withErrors(['message' => 'Email atau password salah.']);
    }
}
