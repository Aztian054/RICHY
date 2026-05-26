<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nip', 50)->nullable()->unique();
            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->enum('divisi', ['Keuangan', 'Umum', 'Program', 'SDM', 'Teknis'])->nullable();
            $table->string('golongan', 20)->nullable();
            $table->enum('status_kepegawaian', ['PNS', 'PPPK', 'Honorer', 'Magang'])->default('PNS');
            $table->string('email')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->enum('role_sistem', ['Pegawai', 'Verifikator-SPJ', 'Kasubbag', 'Kabid', 'Admin'])->default('Pegawai');
            $table->enum('status', ['Aktif', 'Pengajuan-Baru', 'Pelatihan', 'Nonaktif'])->default('Pengajuan-Baru');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};