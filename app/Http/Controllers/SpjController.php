<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spj;
use App\Models\Pegawai;

class SpjController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Pegawai (level 6) hanya melihat SPJ miliknya sendiri
        $query = Spj::with('pengaju', 'creator');
        if ($user->level >= 6) {
            // Pegawai hanya melihat SPJ yang dia buat
            $pegawai = Pegawai::where('user_id', $user->id)->first();
            $query->where('created_by', $user->id)
                  ->orWhere('pengaju_id', $pegawai->id ?? 0);
        }
        
        $spj_list = $query->latest()->get();

        $data = [
            'spj_list' => $spj_list,
            'total_spj' => Spj::count(),
            'spj_bulan_ini' => Spj::whereMonth('created_at', now()->month)->count(),
            'spj_menunggu' => Spj::whereIn('status', ['Diajukan', 'Diverifikasi', 'Diproses'])->count(),
            'spj_disetujui' => Spj::where('status', 'Disetujui')->count(),
            'spj_ditolak' => Spj::where('status', 'Ditolak')->count(),
            'can_approve' => in_array($user->level, [1, 2, 3]),
            'can_verify' => in_array($user->level, [1, 2, 5]),
        ];
        return view('spj.index', $data);
    }

    public function create()
    {
        $pegawai = Pegawai::where('status', 'Aktif')->get();
        return view('spj.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_spj' => 'required|unique:spjs,no_spj',
            'kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'divisi' => 'required',
            'nominal' => 'required|numeric|min:0',
            'pengaju_id' => 'required|exists:pegawais,id',
            'mata_anggaran' => 'nullable',
            'tgl_kegiatan' => 'nullable|date',
            'tgl_selesai' => 'nullable|date',
            'lokasi' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $validated['status'] = $request->input('status', 'Draft');
        $validated['created_by'] = auth()->id();

        Spj::create($validated);
        return redirect()->route('spj.index')->with('success', 'SPJ berhasil dibuat.');
    }

    public function show($id)
    {
        $spj = Spj::with('pengaju', 'creator')->findOrFail($id);
        return response()->json($spj);
    }

    public function update(Request $request, $id)
    {
        $spj = Spj::findOrFail($id);
        $spj->update($request->only(['kegiatan', 'jenis_kegiatan', 'divisi', 'nominal', 'keterangan']));
        return redirect()->route('spj.index')->with('success', 'SPJ berhasil diperbarui.');
    }

    /**
     * Verifikasi SPJ oleh Verifikator (Level 5) atau Admin/Super Admin
     */
    public function verify($id)
    {
        $spj = Spj::findOrFail($id);
        
        if ($spj->status !== 'Diajukan') {
            return back()->with('error', 'SPJ sudah pernah diverifikasi.');
        }

        $spj->update([
            'status' => 'Diverifikasi',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('spj.index')->with('success', 'SPJ berhasil diverifikasi dan siap diapprove.');
    }

    public function approve($id)
    {
        $spj = Spj::findOrFail($id);

        if (!in_array($spj->status, ['Diajukan', 'Diverifikasi', 'Diproses'])) {
            return back()->with('error', 'SPJ tidak dapat disetujui dalam status saat ini.');
        }

        $spj->update([
            'status' => 'Disetujui',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);
        return redirect()->route('spj.index')->with('success', 'SPJ berhasil disetujui.');
    }

    public function reject($id)
    {
        $spj = Spj::findOrFail($id);
        $spj->update([
            'status' => 'Ditolak',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);
        return redirect()->route('spj.index')->with('success', 'SPJ ditolak.');
    }
}