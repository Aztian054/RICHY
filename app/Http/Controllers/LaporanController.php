<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spj;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Pegawai;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'total_spj' => Spj::count(),
            'total_surat_masuk' => SuratMasuk::count(),
            'total_surat_keluar' => SuratKeluar::count(),
            'total_pegawai' => Pegawai::count(),
            'spj_disetujui' => Spj::where('status', 'Disetujui')->count(),
            'spj_ditolak' => Spj::where('status', 'Ditolak')->count(),
            'spj_diajukan' => Spj::whereIn('status', ['Diajukan', 'Diverifikasi', 'Diproses'])->count(),
        ];
        return view('laporan.index', $data);
    }
}