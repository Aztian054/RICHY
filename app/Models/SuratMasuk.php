<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat', 'asal_surat', 'perihal', 'tgl_surat', 'tgl_diterima',
        'sifat', 'kategori', 'scan_path', 'catatan_internal', 'status', 'input_oleh',
    ];

    protected $casts = [
        'tgl_surat' => 'date',
        'tgl_diterima' => 'date',
    ];

    public function inputBy()
    {
        return $this->belongsTo(User::class, 'input_oleh');
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'surat_masuk_id');
    }
}