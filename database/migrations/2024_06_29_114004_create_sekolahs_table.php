<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('type');
            $table->string('paket');
            $table->string('status');
            $table->date('tanggal_kadaluarsa');
            $table->text('alamat');
            $table->text('kelurahan');
            $table->text('kecamatan');
            $table->text('kota');
            $table->text('provinsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
