<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggaran;
use Illuminate\Support\Facades\DB;

class AnggaranController extends Controller
{
    public function index()
    {
        $total_pagu = Anggaran::sum('pagu');
        $total_realisasi = Anggaran::sum('realisasi');

        $data = [
            'total_pagu' => $total_pagu > 0 ? $total_pagu : 2100000000,
            'total_realisasi' => $total_realisasi > 0 ? $total_realisasi : 1388000000,
            'sisa_anggaran' => ($total_pagu > 0 ? $total_pagu : 2100000000) - ($total_realisasi > 0 ? $total_realisasi : 1388000000),
            'persentase' => $total_pagu > 0 ? round(($total_realisasi / $total_pagu) * 100) : round((1388000000 / 2100000000) * 100),
            'anggaran_list' => Anggaran::latest()->get(),
        ];
        return view('anggaran.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'divisi' => 'required|string',
            'pagu' => 'required|numeric|min:0',
            'realisasi' => 'nullable|numeric|min:0',
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'keterangan' => 'nullable|string',
        ]);

        $validated['tahun'] = $validated['tahun'] ?? now()->year;
        $validated['realisasi'] = $validated['realisasi'] ?? 0;

        Anggaran::create($validated);

        return redirect()->route('anggaran.index')->with('success', 'Data anggaran berhasil disimpan.');
    }

    public function chartData()
    {
        $anggaran = Anggaran::selectRaw('divisi, SUM(pagu) as pagu, SUM(realisasi) as realisasi')
            ->groupBy('divisi')
            ->get();

        if ($anggaran->isEmpty()) {
            return response()->json([
                'labels' => ['Keuangan', 'Umum', 'Program', 'SDM', 'Teknis'],
                'data_pagu' => [500000000, 350000000, 400000000, 250000000, 600000000],
                'data_realisasi' => [225000000, 217000000, 312000000, 88000000, 546000000],
            ]);
        }

        return response()->json([
            'labels' => $anggaran->pluck('divisi'),
            'data_pagu' => $anggaran->pluck('pagu'),
            'data_realisasi' => $anggaran->pluck('realisasi'),
        ]);
    }
}