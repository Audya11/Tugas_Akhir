<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
   {
       $sekolahs = Sekolah::all();
       $siswas = Siswa::all();

       // Ambil data dan hitung jumlah sekolah berdasarkan tanggal kadaluarsa
       $sekolahDataByDate = DB::table('sekolahs')
           ->select(DB::raw('DATE(tanggal_kadaluarsa) as date'), DB::raw('count(*) as count'))
           ->groupBy('date')
           ->get();

       // Ambil data dan hitung jumlah sekolah berdasarkan tipe
       $sekolahDataByType = DB::table('sekolahs')
           ->select('type', DB::raw('count(*) as count'))
           ->groupBy('type')
           ->get();

       // Ambil data dan hitung jumlah sekolah berdasarkan provinsi
       $sekolahDataByProvince = DB::table('sekolahs')
           ->select('provinsi', DB::raw('count(*) as count'))
           ->groupBy('provinsi')
           ->get();

        // $sekolahDataByProvince = DB::table('sekolahs')
        // ->join('provinsis', 'sekolahs.provinsi', '=', 'provinsis.id')
        // ->select('provinsis.nama as provinsi', DB::raw('count(*) as count'))
        // ->groupBy('provinsis.nama')
        // ->get();

       // Ambil data provinsi dari API
       $response = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
       $provinsiData = $response->json()['provinsi'];

       return view('admin.dashboard', compact('sekolahs', 'siswas', 'sekolahDataByDate', 'sekolahDataByType', 'sekolahDataByProvince', 'provinsiData'));
    }
   

   
}

