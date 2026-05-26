@extends('layouts.app')
@section('title', 'Profil — RICH ERP')
@section('page_title', 'Profil Saya')
@section('page_subtitle', 'Informasi akun dan aktivitas')
@section('content')
<div class="card" style="background:linear-gradient(135deg,var(--navy-900),var(--navy-700));color:white;overflow:hidden;position:relative">
    <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:rgba(37,99,235,0.15)"></div>
    <div style="position:absolute;bottom:-60px;left:40%;width:160px;height:160px;border-radius:50%;background:rgba(139,92,246,0.1)"></div>
    <div class="flex-center" style="gap:20px;position:relative;z-index:1">
        <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--blue-500),var(--purple-600));display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:700;color:white;flex-shrink:0">
            {{ substr(auth()->user()->name, 0, 2) }}
        </div>
        <div style="flex:1">
            <div style="font-size:18px;font-weight:700">{{ auth()->user()->name }}</div>
            <div style="font-size:12px;color:rgba(255,255,255,0.6)">{{ auth()->user()->level_name ?? 'Pegawai' }} · {{ auth()->user()->instansi ?? 'BPPMHKP' }}</div>
        </div>
        <div class="flex-center" style="gap:20px">
            <div style="text-align:center"><div style="font-size:20px;font-weight:700">{{ \App\Models\Spj::count() }}</div><div style="font-size:10px;color:rgba(255,255,255,0.5)">SPJ</div></div>
            <div style="text-align:center"><div style="font-size:20px;font-weight:700">{{ \App\Models\Arsip::count() }}</div><div style="font-size:10px;color:rgba(255,255,255,0.5)">Arsip</div></div>
            <div style="text-align:center"><div style="font-size:20px;font-weight:700">{{ \App\Models\Pegawai::count() }}</div><div style="font-size:10px;color:rgba(255,255,255,0.5)">Pegawai</div></div>
        </div>
    </div>
</div>

<div class="grid-2 mb-22" style="margin-top:22px">
    <div class="card">
        <div class="card-header"><div class="card-title">Informasi Akun</div><button class="btn btn-sm btn-outline">Edit Profil</button></div>
        <div class="form-row" style="grid-template-columns:1fr 2fr;gap:8px 16px">
            <div class="text-sm text-muted">Username</div><div class="font-semibold text-sm">{{ auth()->user()->email }}</div>
            <div class="text-sm text-muted">Nama Lengkap</div><div class="font-semibold text-sm">{{ auth()->user()->name }}</div>
            <div class="text-sm text-muted">Level Akses</div><div><span class="badge badge-purple">{{ auth()->user()->level_name ?? 'Pegawai' }}</span></div>
            <div class="text-sm text-muted">Instansi</div><div class="font-semibold text-sm">{{ auth()->user()->instansi ?? 'BPPMHKP' }}</div>
            <div class="text-sm text-muted">Terakhir Login</div><div class="font-semibold text-sm">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d/m/Y H:i') : '-' }}</div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><div class="card-title">Ganti Password</div></div>
        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group"><label class="form-label">Password Lama</label><input type="password" name="current_password" class="form-input" placeholder="Masukkan password lama" required></div>
            <div class="form-group"><label class="form-label">Password Baru</label><input type="password" name="new_password" class="form-input" placeholder="Min. 8 karakter" required></div>
            <div class="form-group"><label class="form-label">Konfirmasi Password</label><input type="password" name="new_password_confirmation" class="form-input" placeholder="Ulangi password baru" required></div>
            @error('current_password') <div class="form-hint" style="color:var(--red-600)">{{ $message }}</div> @enderror
            @error('new_password') <div class="form-hint" style="color:var(--red-600)">{{ $message }}</div> @enderror
            <button type="submit" class="btn btn-primary">💾 Simpan Password</button>
        </form>
    </div>
</div>

<div class="table-container">
    <div class="table-toolbar"><div class="font-bold text-sm">Log Aktivitas</div></div>
    <table>
        <thead><tr><th>Waktu</th><th>Aktivitas</th><th>Modul</th><th>Status</th></tr></thead>
        <tbody>
            <tr><td><span class="font-mono" style="font-size:12px">{{ now()->format('d/m/Y H:i') }}</span></td><td class="font-semibold">Login ke sistem</td><td>Auth</td><td><span class="badge badge-green">Berhasil</span></td></tr>
            <tr><td><span class="font-mono" style="font-size:12px">{{ now()->subMinutes(30)->format('d/m/Y H:i') }}</span></td><td class="font-semibold">Melihat dashboard</td><td>Dashboard</td><td><span class="badge badge-green">Berhasil</span></td></tr>
        </tbody>
    </table>
</div>
@endsection