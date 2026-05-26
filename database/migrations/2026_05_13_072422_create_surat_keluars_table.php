<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->string('tujuan');
            $table->text('alamat_tujuan')->nullable();
            $table->text('perihal');
            $table->text('isi_ringkasan')->nullable();
            $table->date('tgl_surat');
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->string('file_path')->nullable();
            $table->enum('status', ['Draft', 'Dalam-Pengiriman', 'Terkirim'])->default('Draft');
            $table->date('tgl_kirim')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};