@extends('layouts.app')
@section('title', 'SPJ Keuangan — RICH ERP')
@section('page_title', 'SPJ Keuangan')
@section('page_subtitle', 'Pengelolaan Surat Pertanggungjawaban')
@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        <span class="alert-icon">✅</span>
        <div class="alert-content">{{ session('success') }}</div>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
    </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header"><div class="stat-card-label">SPJ Bulan Ini</div><div class="stat-card-icon blue">💰</div></div>
            <div class="stat-card-value">{{ $spj_bulan_ini }}</div>
            <div class="stat-card-sub">Total pengajuan bulan berjalan</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-card-header"><div class="stat-card-label">Menunggu</div><div class="stat-card-icon amber">⏳</div></div>
            <div class="stat-card-value">{{ $spj_menunggu }}</div>
            <div class="stat-card-sub">Perlu persetujuan</div>
        </div>
        <div class="stat-card green">
            <div class="stat-card-header"><div class="stat-card-label">Disetujui</div><div class="stat-card-icon green">✅</div></div>
            <div class="stat-card-value">{{ $spj_disetujui }}</div>
            <div class="stat-card-sub">SPJ yang sudah disetujui</div>
        </div>
        <div class="stat-card red">
            <div class="stat-card-header"><div class="stat-card-label">Ditolak</div><div class="stat-card-icon red">❌</div></div>
            <div class="stat-card-value">{{ $spj_ditolak }}</div>
            <div class="stat-card-sub">SPJ yang ditolak</div>
        </div>
    </div>

    <div class="flex-between mb-16">
        <div class="tabs" style="margin-bottom:0">
            <div class="tab active">📋 Semua <span class="tab-count">{{ $total_spj }}</span></div>
            <div class="tab">⏳ Pending</div>
            <div class="tab">✅ Disetujui</div>
            <div class="tab">❌ Ditolak</div>
        </div>
        <a href="{{ route('spj.create') }}" class="btn btn-primary">➕ Buat SPJ Baru</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width:30px"><input type="checkbox"></th>
                    <th>No. SPJ</th>
                    <th>Kegiatan</th>
                    <th>Pengaju</th>
                    <th>Divisi</th>
                    <th>Nominal</th>
                    <th>Tgl. Pengajuan</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($spj_list as $spj)
                <tr>
                    <td><input type="checkbox"></td>
                    <td><span class="mono text-navy font-semibold">{{ $spj->no_spj }}</span></td>
                    <td>
                        <div class="font-semibold">{{ $spj->kegiatan }}</div>
                        <span class="text-xs text-muted">{{ str_replace('-', ' ', $spj->jenis_kegiatan) }}</span>
                    </td>
                    <td>{{ $spj->pengaju->nama ?? '-' }}</td>
                    <td>{{ $spj->divisi ?? '-' }}</td>
                    <td><span class="mono font-semibold">Rp {{ number_format($spj->nominal, 0, ',', '.') }}</span></td>
                    <td><span class="font-mono" style="font-size:12px">{{ $spj->created_at->format('d/m/Y') }}</span></td>
                    <td>
                        @php
                            $statusBadge = match($spj->status) {
                                'Diajukan' => 'badge-blue', 'Diverifikasi' => 'badge-amber', 'Diproses' => 'badge-amber',
                                'Disetujui' => 'badge-green', 'Ditolak' => 'badge-red', default => 'badge-slate'
                            };
                        @endphp
                        <span class="badge {{ $statusBadge }}">{{ $spj->status }}</span>
                    </td>
                    <td>
                        <div class="flex" style="gap:4px">
                            <button class="btn btn-sm btn-ghost" onclick="lihatSpj({{ $spj->id }})">👁️</button>
                            
                            @if ($spj->status == 'Draft')
                                <form action="{{ route('spj.update', $spj->id) }}" method="POST" style="display:inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="Diajukan">
                                    <button class="btn btn-sm btn-primary">📤 Ajukan</button>
                                </form>
                                <button class="btn btn-sm btn-outline">Edit</button>
                            
                            @elseif ($spj->status == 'Diajukan' && $can_verify)
                                <form action="{{ route('spj.verify', $spj->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-sm btn-info" style="background:var(--blue-500);color:white">🔍 Verifikasi</button>
                                </form>
                            
                            @elseif (in_array($spj->status, ['Diajukan','Diverifikasi','Diproses']) && $can_approve)
                                <form action="{{ route('spj.approve', $spj->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">✅ Setuju</button>
                                </form>
                                <form action="{{ route('spj.reject', $spj->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">❌ Tolak</button>
                                </form>

                            @elseif ($spj->status == 'Diajukan' || $spj->status == 'Diverifikasi')
                                <span class="text-xs text-muted">Menunggu {{ $spj->status == 'Diajukan' ? 'Verifikator' : 'Approval Kabid' }}</span>

                            @elseif ($spj->status == 'Ditolak')
                                <button class="btn btn-sm btn-warning">Revisi</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9"><div class="empty-state"><div class="empty-icon">💰</div><div class="empty-text">Belum ada SPJ</div></div></td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="table-footer"><span>Menampilkan {{ $total_spj }} data</span></div>
    </div>
@endsection