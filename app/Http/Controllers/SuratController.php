<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;

class SuratController extends Controller
{
    /**
     * Menampilkan halaman utama surat & disposisi.
     */
    public function index()
    {
        $data = [
            'total_surat_masuk' => SuratMasuk::count(),
            'surat_belum_disposisi' => SuratMasuk::where('status', 'Belum-Disposisi')->count(),
            'total_surat_keluar' => SuratKeluar::count(),
            'disposisi_selesai' => Disposisi::where('status', 'Selesai')->count(),
            'total_disposisi' => Disposisi::count(),
            'surat_masuk' => SuratMasuk::with('inputBy')->latest()->get(),
            'surat_keluar' => SuratKeluar::with('dibuatOleh')->latest()->get(),
            'disposisi' => Disposisi::with('suratMasuk', 'dariUser', 'kepadaUser')->latest()->get(),
        ];

        return view('surat.index', $data);
    }

    /**
     * Menyimpan surat masuk baru.
     */
    public function storeMasuk(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string',
            'asal_surat' => 'required|string',
            'perihal' => 'required|string',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'sifat' => 'required|in:Biasa,Penting,Segera,Rahasia',
            'kategori' => 'nullable|string',
        ]);

        $validated['input_oleh'] = auth()->id();
        $validated['status'] = 'Belum-Disposisi';

        SuratMasuk::create($validated);

        return redirect()->route('surat.index')->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    /**
     * Menyimpan surat keluar baru.
     */
    public function storeKeluar(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|unique:surat_keluars,no_surat',
            'tujuan' => 'required|string',
            'perihal' => 'required|string',
            'tgl_surat' => 'required|date',
        ]);

        $validated['dibuat_oleh'] = auth()->id();
        $validated['status'] = 'Draft';

        SuratKeluar::create($validated);

        return redirect()->route('surat.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    /**
     * Mengirim disposisi untuk surat masuk tertentu.
     */
    public function disposisi(Request $request, $id)
    {
        $validated = $request->validate([
            'kepada_user_id' => 'required|exists:users,id',
            'instruksi' => 'required|string',
            'batas_waktu' => 'required|date',
            'prioritas' => 'required|in:Normal,Penting,Urgent',
        ]);

        $suratMasuk = SuratMasuk::findOrFail($id);

        $validated['surat_masuk_id'] = $id;
        $validated['dari_user_id'] = auth()->id();
        $validated['status'] = 'Menunggu';

        Disposisi::create($validated);

        // Update status surat masuk
        $suratMasuk->update(['status' => 'Sudah-Disposisi']);

        return redirect()->route('surat.index')->with('success', 'Disposisi berhasil dikirim.');
    }

    /**
     * Menampilkan detail surat masuk.
     */
    public function showMasuk($id)
    {
        $surat = SuratMasuk::with('inputBy', 'disposisi.dariUser', 'disposisi.kepadaUser')->findOrFail($id);
        return response()->json($surat);
    }
}