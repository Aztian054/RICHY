@extends('layouts.app')
@section('title', 'Buat SPJ Baru — RICH ERP')
@section('page_title', 'Buat SPJ Baru')
@section('page_subtitle', 'Form pengajuan Surat Pertanggungjawaban')
@section('content')
<div class="card" style="max-width:720px;margin:0 auto">
    <form action="{{ route('spj.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">No. SPJ</label>
                <input type="text" name="no_spj" class="form-input" placeholder="SPJ-XXX" required>
                @error('no_spj') <div class="form-hint" style="color:var(--red-600)">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Kegiatan</label>
                <select name="jenis_kegiatan" class="form-input" required>
                    <option value="">— Pilih —</option>
                    <option value="Perjalanan-Dinas">Perjalanan Dinas</option>
                    <option value="Pengadaan">Pengadaan</option>
                    <option value="Rapat">Rapat</option>
                    <option value="Pelatihan">Pelatihan</option>
                    <option value="Sosialisasi">Sosialisasi</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Kegiatan</label>
            <input type="text" name="kegiatan" class="form-input" placeholder="Nama kegiatan" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Divisi</label>
                <select name="divisi" class="form-input" required>
                    <option value="">— Pilih —</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Umum">Umum</option>
                    <option value="Program">Program</option>
                    <option value="SDM">SDM</option>
                    <option value="Teknis">Teknis</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Nominal (Rp)</label>
                <input type="number" name="nominal" class="form-input" placeholder="0" min="0" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Pengaju</label>
                <select name="pengaju_id" class="form-input" required>
                    <option value="">— Pilih Pegawai —</option>
                    @foreach ($pegawai as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->nip ?? '-' }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Mata Anggaran</label>
                <input type="text" name="mata_anggaran" class="form-input" placeholder="Kode anggaran">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Tanggal Kegiatan</label>
                <input type="date" name="tgl_kegiatan" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-input" placeholder="Lokasi kegiatan">
        </div>
        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-input form-textarea" placeholder="Deskripsi kegiatan..."></textarea>
        </div>
        <div class="flex-between">
            <a href="{{ route('spj.index') }}" class="btn btn-outline">← Kembali</a>
            <div class="flex" style="gap:8px">
                <button type="submit" name="status" value="Draft" class="btn btn-outline">💾 Simpan Draft</button>
                <button type="submit" name="status" value="Diajukan" class="btn btn-primary">📤 Ajukan SPJ</button>
            </div>
        </div>
    </form>
</div>
@endsection