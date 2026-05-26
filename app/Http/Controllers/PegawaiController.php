<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = [
            'pegawai_list' => Pegawai::latest()->get(),
            'total_pegawai' => Pegawai::count(),
            'pegawai_aktif' => Pegawai::where('status', 'Aktif')->count(),
            'pegawai_pengajuan' => Pegawai::where('status', 'Pengajuan-Baru')->count(),
            'pegawai_pelatihan' => Pegawai::where('status', 'Pelatihan')->count(),
        ];
        return view('pegawai.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'nullable|unique:pegawais,nip',
            'jabatan' => 'nullable',
            'divisi' => 'nullable',
            'status_kepegawaian' => 'required',
        ]);
        $validated['status'] = 'Pengajuan-Baru';
        Pegawai::create($validated);
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show($id)
    {
        return response()->json(Pegawai::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai diperbarui.');
    }

    public function approve($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update(['status' => 'Aktif']);
        return redirect()->route('pegawai.index')->with('success', 'Pegawai disetujui.');
    }
}