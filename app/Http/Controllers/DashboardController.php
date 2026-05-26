<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Spj;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Pegawai;
use App\Models\Arsip;
use App\Models\Anggaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama — semua data dari database.
     */
    public function index()
    {
        // SPJ stats
        $spj_terbaru = Spj::with('pengaju')->latest()->take(5)->get();
        $chart_spj = Spj::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // Aktivitas terkini dari SPJ (create/approve/reject)
        $aktivitas_spj = Spj::whereNotNull('created_at')->latest()->take(5)->get()->map(function ($s) {
            $warna = match ($s->status) {
                'Disetujui' => 'green',
                'Ditolak'   => 'red',
                'Diajukan'  => 'blue',
                default     => 'amber',
            };
            return (object) [
                'judul'     => $s->no_spj . ' — ' . $s->status,
                'deskripsi' => $s->kegiatan . ' (Rp ' . number_format($s->nominal, 0, ',', '.') . ')',
                'warna'     => $warna,
                'created_at'=> $s->created_at,
            ];
        });

        // Serapan anggaran per divisi
        $serapan_anggaran = Anggaran::selectRaw('divisi, SUM(pagu) as pagu, SUM(realisasi) as realisasi')
            ->groupBy('divisi')
            ->get();

        // Pegawai per divisi untuk chart
        $pegawai_divisi = Pegawai::selectRaw('COALESCE(divisi, "Tanpa Divisi") as divisi, COUNT(*) as total')
            ->groupBy('divisi')
            ->pluck('total', 'divisi');

        $data = [
            'total_spj_bulan_ini'  => Spj::whereMonth('created_at', now()->month)->count(),
            'spj_diajukan'         => Spj::where('status', 'Diajukan')->count(),
            'spj_disetujui'        => Spj::where('status', 'Disetujui')->count(),
            'spj_ditolak'          => Spj::where('status', 'Ditolak')->count(),
            'spj_menunggu'         => Spj::whereIn('status', ['Diajukan', 'Diverifikasi'])->count(),
            'spj_terbaru'          => $spj_terbaru,
            'aktivitas_terkini'    => $aktivitas_spj,

            'total_surat_masuk'    => SuratMasuk::count(),
            'surat_belum_disposisi'=> SuratMasuk::where('status', 'Belum-Disposisi')->count(),
            'total_surat_keluar'   => SuratKeluar::count(),

            'total_pegawai'        => Pegawai::count(),
            'pegawai_aktif'        => Pegawai::where('status', 'Aktif')->count(),
            'pegawai_pengajuan_baru' => Pegawai::where('status', 'Pengajuan-Baru')->count(),

            'total_arsip'          => Arsip::count(),

            'serapan_anggaran'     => $serapan_anggaran,

            // Chart data
            'chart_spj_labels'     => $chart_spj->keys()->toArray(),
            'chart_spj_data'       => $chart_spj->values()->toArray(),
            'chart_divisi_labels'  => $pegawai_divisi->keys()->toArray(),
            'chart_divisi_data'    => $pegawai_divisi->values()->toArray(),
        ];

        return view('dashboard.index', $data);
    }

    /**
     * API endpoint untuk data statistik dashboard (AJAX).
     */
    public function stats()
    {
        $monthlySpj = Spj::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total, 
            SUM(CASE WHEN status = "Disetujui" THEN 1 ELSE 0 END) as disetujui,
            SUM(CASE WHEN status = "Ditolak" THEN 1 ELSE 0 END) as ditolak')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $statusDistribution = Spj::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $pegawaiPerDivisi = Pegawai::selectRaw('COALESCE(divisi, "Tanpa Divisi") as divisi, COUNT(*) as total')
            ->groupBy('divisi')
            ->get();

        return response()->json([
            'monthly_spj' => $monthlySpj,
            'status_distribution' => $statusDistribution,
            'pegawai_per_divisi' => $pegawaiPerDivisi,
        ]);
    }
}