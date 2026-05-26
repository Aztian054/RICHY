<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_spj',
        'kegiatan',
        'jenis_kegiatan',
        'divisi',
        'nominal',
        'mata_anggaran',
        'tgl_kegiatan',
        'tgl_selesai',
        'lokasi',
        'pengaju_id',
        'keterangan',
        'status',
        'tgl_batas',
        'created_by',
        'approved_by',
        'approved_at',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tgl_kegiatan' => 'date',
        'tgl_selesai' => 'date',
        'tgl_batas' => 'date',
    ];

    public function pengaju()
    {
        return $this->belongsTo(Pegawai::class, 'pengaju_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvalLogs()
    {
        return $this->hasMany(SpjApprovalLog::class);
    }

    public function dokumen()
    {
        return $this->hasMany(SpjDokumen::class);
    }
}