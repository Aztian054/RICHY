<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->string('asal_surat');
            $table->text('perihal');
            $table->date('tgl_surat');
            $table->date('tgl_diterima');
            $table->enum('sifat', ['Biasa', 'Penting', 'Segera', 'Rahasia'])->default('Biasa');
            $table->string('kategori')->nullable();
            $table->string('scan_path')->nullable();
            $table->text('catatan_internal')->nullable();
            $table->enum('status', ['Belum-Disposisi', 'Sudah-Disposisi', 'Selesai'])->default('Belum-Disposisi');
            $table->foreignId('input_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};