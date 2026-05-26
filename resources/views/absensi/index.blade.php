@extends('layouts.app')
@section('title', 'Absensi — RICH ERP')
@section('page_title', 'Absensi')
@section('page_subtitle', 'Rekap kehadiran ASN BPPMHKP')
@section('content')
<div class="stats-grid">
    <div class="stat-card green"><div class="stat-card-header"><div class="stat-card-label">Hadir Hari Ini</div><div class="stat-card-icon green">📊</div></div><div class="stat-card-value">{{ $total_hadir }}</div><div class="stat-card-sub">Dari {{ $total_aktif }} pegawai aktif</div></div>
    <div class="stat-card red"><div class="stat-card-header"><div class="stat-card-label">Izin</div><div class="stat-card-icon red">🩺</div></div><div class="stat-card-value">{{ $total_izin }}</div><div class="stat-card-sub">Hari ini</div></div>
    <div class="stat-card amber"><div class="stat-card-header"><div class="stat-card-label">Sakit</div><div class="stat-card-icon amber">⏰</div></div><div class="stat-card-value">{{ $total_sakit }}</div><div class="stat-card-sub">Hari ini</div></div>
    <div class="stat-card blue"><div class="stat-card-header"><div class="stat-card-label">Pegawai Aktif</div><div class="stat-card-icon blue">⭐</div></div><div class="stat-card-value">{{ $total_aktif }}</div><div class="stat-card-sub">Total ASN</div></div>
</div>

<div class="table-container">
    <div class="table-toolbar">
        <div class="font-bold text-sm">Rekap Absensi Bulan {{ date('F Y') }}</div>
        <div style="margin-left:auto">
            <select class="filter-select" style="min-width:120px"><option>Bulan Ini</option><option>Bulan Lalu</option></select>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpa</th>
                <th>% Kehadiran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensi_hari_ini as $a)
            <tr>
                <td><div class="flex-center" style="gap:8px"><div class="sidebar-user-avatar" style="width:26px;height:26px;font-size:10px;background:linear-gradient(135deg,#2563eb,#8b5cf6)">{{ substr($a->pegawai->nama ?? '-', 0, 2) }}</div><span class="font-semibold">{{ $a->pegawai->nama ?? '-' }}</span></div></td>
                <td>{{ $a->pegawai->divisi ?? '-' }}</td>
                <td><span class="font-bold text-success">{{ $a->status == 'Hadir' ? '✓' : '-' }}</span></td>
                <td>{{ $a->status == 'Izin' ? '✓' : '-' }}</td>
                <td>{{ $a->status == 'Sakit' ? '✓' : '-' }}</td>
                <td>{{ $a->status == 'Tanpa-Keterangan' ? '✓' : '-' }}</td>
                <td>
                    @php
                        $pct = $a->status == 'Hadir' ? 100 : 0;
                        $color = $pct == 100 ? 'green' : 'red';
                    @endphp
                    <span class="font-bold" style="color:var(--{{ $color }}-600)">{{ $pct }}%</span>
                </td>
                <td>
                    @php
                        $cls = match($a->status) {
                            'Hadir' => 'badge-green', 'Izin' => 'badge-amber',
                            'Sakit' => 'badge-red', default => 'badge-slate'
                        };
                    @endphp
                    <span class="badge {{ $cls }}">{{ $a->status }}</span>
                </td>
            </tr>
            @empty
                @forelse ($pegawai_list as $p)
                <tr>
                    <td><div class="flex-center" style="gap:8px"><div class="sidebar-user-avatar" style="width:26px;height:26px;font-size:10px;background:linear-gradient(135deg,#2563eb,#8b5cf6)">{{ substr($p->nama, 0, 2) }}</div><span class="font-semibold">{{ $p->nama }}</span></div></td>
                    <td>{{ $p->divisi ?? '-' }}</td>
                    <td>-</td><td>-</td><td>-</td><td>-</td>
                    <td><span class="font-bold" style="color:var(--slate-500)">0%</span></td>
                    <td><span class="badge badge-slate">Belum Absen</span></td>
                </tr>
                @empty
                <tr><td colspan="8"><div class="empty-state"><div class="empty-icon">📅</div><div class="empty-text">Belum ada data absensi</div></div></td></tr>
                @endforelse
            @endforelse
        </tbody>
    </table>
    <div class="table-footer"><span>Menampilkan {{ $total_aktif }} pegawai</span></div>
</div>
@endsection