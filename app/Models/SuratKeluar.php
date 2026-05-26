<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat', 'tujuan', 'alamat_tujuan', 'perihal', 'isi_ringkasan',
        'tgl_surat', 'dibuat_oleh', 'file_path', 'status', 'tgl_kirim',
    ];

    protected $casts = [
        'tgl_surat' => 'date',
        'tgl_kirim' => 'date',
    ];

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}