<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spjs', function (Blueprint $table) {
            $table->id();
            $table->string('no_spj', 50)->unique();
            $table->string('kegiatan');
            $table->enum('jenis_kegiatan', ['Perjalanan-Dinas', 'Pengadaan', 'Rapat', 'Pelatihan', 'Sosialisasi', 'Lainnya'])->default('Lainnya');
            $table->enum('divisi', ['Keuangan', 'Umum', 'Program', 'SDM', 'Teknis'])->nullable();
            $table->decimal('nominal', 18, 2)->default(0);
            $table->string('mata_anggaran', 100)->nullable();
            $table->date('tgl_kegiatan')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->foreignId('pengaju_id')->nullable()->constrained('pegawais')->nullOnDelete();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Draft', 'Diajukan', 'Diverifikasi', 'Diproses', 'Disetujui', 'Ditolak'])->default('Draft');
            $table->date('tgl_batas')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spjs');
    }
};