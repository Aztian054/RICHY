<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'jabatan',
        'divisi',
        'golongan',
        'status_kepegawaian',
        'email',
        'no_hp',
        'tgl_mulai',
        'role_sistem',
        'status',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}