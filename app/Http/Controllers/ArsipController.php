<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index()
    {
        $data = [
            'arsip_list' => Arsip::with('uploadedBy')->latest()->get(),
            'total_arsip' => Arsip::count(),
            'arsip_spj' => Arsip::where('kategori', 'SPJ')->count(),
            'arsip_surat' => Arsip::where('kategori', 'Surat')->count(),
            'arsip_laporan' => Arsip::where('kategori', 'Laporan')->count(),
            'arsip_sk' => Arsip::where('kategori', 'SK')->count(),
            'arsip_teknis' => Arsip::where('kategori', 'Teknis')->count(),
        ];
        return view('arsip.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_file' => 'required|string',
            'kategori' => 'required|string',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // Max 10MB
        ]);

        $validated['uploaded_by'] = auth()->id();
        $validated['format_file'] = 'unknown';

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('arsip', 'public');
            $validated['path_file'] = $path;
            $validated['format_file'] = $file->getClientOriginalExtension();
            $validated['ukuran_byte'] = $file->getSize();
        } else {
            $validated['ukuran_byte'] = 0;
        }

        Arsip::create($validated);

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function download($id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($arsip->path_file) {
            $fullPath = public_path('storage/' . $arsip->path_file);
            if (file_exists($fullPath)) {
                return response()->download($fullPath, $arsip->nama_file);
            }
        }

        // Fallback: if no file stored, return JSON info
        return response()->json([
            'id' => $arsip->id,
            'nama' => $arsip->nama_file,
            'kategori' => $arsip->kategori,
            'ukuran' => $arsip->ukuran_byte,
            'keterangan' => $arsip->keterangan,
            'uploaded_by' => $arsip->uploadedBy->name ?? '-',
            'created_at' => $arsip->created_at->format('d/m/Y'),
        ]);
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        // Delete file from storage
        if ($arsip->path_file && Storage::disk('public')->exists($arsip->path_file)) {
            Storage::disk('public')->delete($arsip->path_file);
        }

        $arsip->delete();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }
}