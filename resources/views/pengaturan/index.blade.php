@extends('layouts.app')
@section('title', 'Pengaturan — RICH ERP')
@section('page_title', 'Pengaturan Sistem')
@section('page_subtitle', 'Konfigurasi aplikasi')
@section('content')
<div class="grid-2">
    <div>
        <div class="card mb-16">
            <div class="card-header"><div class="card-title">🔔 Notifikasi</div></div>
            @foreach(['SPJ Keuangan' => true, 'Surat & Disposisi' => true, 'Kepegawaian' => false, 'Email Digest Harian' => false] as $label => $checked)
            <div class="flex-between" style="padding:10px 0;border-bottom:1px solid var(--slate-100)">
                <span class="font-semibold text-sm">{{ $label }}</span>
                <label class="toggle"><input type="checkbox" {{ $checked ? 'checked' : '' }}><span class="toggle-slider"></span></label>
            </div>
            @endforeach
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">💰 Keuangan</div></div>
            <div class="form-group"><label class="form-label">Batas Nilai SPJ Auto-Approve</label><input type="text" class="form-input" value="Rp 5.000.000"></div>
            <div class="form-group"><label class="form-label">Batas Waktu Persetujuan (hari)</label><input type="number" class="form-input" value="7"></div>
        </div>
    </div>
    <div>
        <div class="card mb-16">
            <div class="card-header"><div class="card-title">🔒 Sistem & Keamanan</div></div>
            @foreach(['Aktifkan 2FA' => false, 'Log Semua Aktivitas' => true, 'Mode Maintenance' => false] as $label => $checked)
            <div class="flex-between" style="padding:10px 0;border-bottom:1px solid var(--slate-100)">
                <span class="font-semibold text-sm">{{ $label }}</span>
                <label class="toggle"><input type="checkbox" {{ $checked ? 'checked' : '' }}><span class="toggle-slider"></span></label>
            </div>
            @endforeach
            <div class="form-group" style="margin-top:12px"><label class="form-label">Nama Instansi</label><input type="text" class="form-input" value="BPPMHKP"></div>
            <div class="form-group"><label class="form-label">Session Timeout (menit)</label><input type="number" class="form-input" value="120"></div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">👥 Manajemen User</div><button class="btn btn-sm btn-primary">➕ Tambah User</button></div>
            <table style="width:100%;font-size:12px">
                <thead><tr><th>Nama</th><th>Role</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @foreach (\App\Models\User::all() as $user)
                    <tr>
                        <td class="font-semibold">{{ $user->name }}</td>
                        <td><span class="badge badge-purple">{{ $user->level_name }}</span></td>
                        <td><span class="badge {{ $user->is_active ? 'badge-green' : 'badge-red' }}">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td><button class="btn btn-sm btn-ghost">✏️</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="flex-between" style="margin-top:16px">
    <div></div>
    <button class="btn btn-primary btn-lg">💾 Simpan Pengaturan</button>
</div>
@endsection