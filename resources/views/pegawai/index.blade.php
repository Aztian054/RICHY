@extends('layouts.app')
@section('title', 'Kepegawaian — RICH ERP')
@section('page_title', 'Kepegawaian')
@section('page_subtitle', 'Data ASN BPPMHKP')
@section('content')
<div class="stats-grid">
    <div class="stat-card purple">
        <div class="stat-card-header"><div class="stat-card-label">Total Pegawai</div><div class="stat-card-icon purple">👥</div></div>
        <div class="stat-card-value">{{ $total_pegawai }}</div>
        <div class="stat-card-sub">Seluruh ASN BPPMHKP</div>
    </div>
    <div class="stat-card green">
        <div class="stat-card-header"><div class="stat-card-label">Aktif</div><div class="stat-card-icon green">✅</div></div>
        <div class="stat-card-value">{{ $pegawai_aktif }}</div>
        <div class="stat-card-sub">Pegawai aktif</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-card-header"><div class="stat-card-label">Pengajuan Baru</div><div class="stat-card-icon amber">🆕</div></div>
        <div class="stat-card-value">{{ $pegawai_pengajuan }}</div>
        <div class="stat-card-sub">Menunggu persetujuan</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-card-header"><div class="stat-card-label">Pelatihan</div><div class="stat-card-icon blue">📚</div></div>
        <div class="stat-card-value">{{ $pegawai_pelatihan }}</div>
        <div class="stat-card-sub">Dalam pelatihan</div>
    </div>
</div>

@if ($pegawai_pengajuan > 0)
<div class="alert alert-success">
    <span class="alert-icon">👤</span>
    <div class="alert-content">
        <span class="alert-title">Pegawai Baru!</span>
        @foreach($pegawai_list->where('status', 'Pengajuan-Baru') as $p)
            <div>{{ $p->nama }} — {{ $p->divisi }}</div>
        @endforeach
    </div>
</div>
@endif

<div class="table-container">
    <div class="table-toolbar">
        <div class="font-bold text-sm">Daftar Pegawai</div>
        <div style="margin-left:auto">
            <button class="btn btn-primary btn-sm">➕ Tambah Pegawai</button>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width:30px"><input type="checkbox"></th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Divisi</th>
                <th>Golongan</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawai_list as $p)
            <tr>
                <td><input type="checkbox"></td>
                <td><span class="mono text-navy font-semibold">{{ $p->nip ?? '-' }}</span></td>
                <td>
                    <div class="flex-center" style="gap:8px">
                        <div class="sidebar-user-avatar" style="width:28px;height:28px;font-size:10px;background:linear-gradient(135deg,#2563eb,#8b5cf6)">{{ substr($p->nama, 0, 2) }}</div>
                        <span class="font-semibold">{{ $p->nama }}</span>
                    </div>
                </td>
                <td>{{ $p->jabatan ?? '-' }}</td>
                <td>{{ $p->divisi ?? '-' }}</td>
                <td>{{ $p->golongan ?? '-' }}</td>
                <td>
                    @php
                        $badgeClass = match($p->status) {
                            'Aktif' => 'badge-green', 'Pengajuan-Baru' => 'badge-amber',
                            'Pelatihan' => 'badge-blue', default => 'badge-slate'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $p->status }}</span>
                </td>
                <td>
                    <div class="flex" style="gap:4px">
                        <button class="btn btn-sm btn-ghost">👁️</button>
                        <button class="btn btn-sm btn-outline">Edit</button>
                        @if ($p->status == 'Pengajuan-Baru')
                            <form action="{{ route('pegawai.approve', $p->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-sm btn-success">Setujui</button>
                            </form>
                            <button class="btn btn-sm btn-danger">Tolak</button>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8"><div class="empty-state"><div class="empty-icon">👥</div><div class="empty-text">Belum ada data pegawai</div></div></td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="table-footer"><span>Menampilkan {{ $total_pegawai }} data</span></div>
</div>
@endsection