<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sekolah;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password', // Gantilah ini dengan password yang aman
            'role' => 'super_admin',
        ]);
        // $school     = User::create([
        //     'name' => 'Admin Sekolah',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('password'), // Gantilah ini dengan password yang aman
        //     'role' => 'school',
        // ]);

        // Membuat 5 sekolah yang terkait dengan superadmin
        // $sekolah1 = Sekolah::create([
        //     'type' => 'SMK',
        //     'status' => 'Aktif',
        //     'paket' => 'Bronze',
        //     'tanggal_kadaluarsa' => '2023-12-31',
        //     'Alamat' => 'Jl. A',
        //     'kelurahan' => 'Sekeloa',

        // ]);
        // $sekolah2 = Sekolah::create(['nama_sekolah' => 'Sekolah B', 'alamat' => 'Alamat B', 'telepon' => '123456789']);
        // $sekolah3 = Sekolah::create(['nama_sekolah' => 'Sekolah C', 'alamat' => 'Alamat C', 'telepon' => '123456789']);
        // $sekolah4 = Sekolah::create(['nama_sekolah' => 'Sekolah D', 'alamat' => 'Alamat D', 'telepon' => '123456789']);
        // $sekolah5 = Sekolah::create(['nama_sekolah' => 'Sekolah E', 'alamat' => 'Alamat E', 'telepon' => '123456789']);

        // // Menghubungkan superadmin dengan sekolah-sekolah tersebut
        // $superAdmin->sekolah()->attach([$sekolah1->id, $sekolah2->id, $sekolah3->id, $sekolah4->id, $sekolah5->id]);
        // $superAdmin->sekolah()->attach([$sekolah1->id]);

    }
}
