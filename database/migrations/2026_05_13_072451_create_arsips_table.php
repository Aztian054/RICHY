<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->enum('kategori', ['SPJ', 'Surat', 'Laporan', 'SK', 'Teknis', 'Lainnya'])->default('Lainnya');
            $table->string('format_file', 20)->nullable();
            $table->string('path_file')->nullable();
            $table->bigInteger('ukuran_byte')->default(0);
            $table->text('keterangan')->nullable();
            $table->integer('referensi_id')->nullable();
            $table->string('referensi_type')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};