<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        $data = [
            'pegawai_list' => Pegawai::where('status', 'Aktif')->get(),
            'total_aktif' => Pegawai::where('status', 'Aktif')->count(),
            'absensi_hari_ini' => Absensi::whereDate('tanggal', today())->with('pegawai')->latest()->get(),
            'total_hadir' => Absensi::whereDate('tanggal', today())->where('status', 'Hadir')->count(),
            'total_izin' => Absensi::whereDate('tanggal', today())->where('status', 'Izin')->count(),
            'total_sakit' => Absensi::whereDate('tanggal', today())->where('status', 'Sakit')->count(),
        ];
        return view('absensi.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Cuti,Tanpa-Keterangan',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();

        // Prevent duplicate absensi for same pegawai on same day
        Absensi::updateOrCreate(
            ['pegawai_id' => $validated['pegawai_id'], 'tanggal' => $validated['tanggal']],
            $validated
        );

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil disimpan.');
    }
}