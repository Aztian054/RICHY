@extends('layouts.app')

@section('title', 'Dashboard — RICH ERP')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan sistem RICH ERP BPPMHKP')

@section('content')
    <!-- Alert Banners -->
    @if ($spj_menunggu > 0)
    <div class="alert alert-info">
        <span class="alert-icon">ℹ️</span>
        <div class="alert-content">
            <span class="alert-title">Perhatian!</span>
            Terdapat <strong>{{ $spj_menunggu }} SPJ</strong> yang menunggu persetujuan.
            <a href="{{ route('spj.index') }}" class="alert-link">Lihat SPJ →</a>
        </div>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
    </div>
    @endif

    @if ($surat_belum_disposisi > 0)
    <div class="alert alert-warning">
        <span class="alert-icon">⚠️</span>
        <div class="alert-content">
            <span class="alert-title">Perhatian!</span>
            Terdapat <strong>{{ $surat_belum_disposisi }} surat masuk</strong> yang belum didisposisi.
            <a href="{{ route('surat.index') }}" class="alert-link">Lihat Surat →</a>
        </div>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-label">SPJ Bulan Ini</div>
                <div class="stat-card-icon blue">💰</div>
            </div>
            <div class="stat-card-value">{{ $total_spj_bulan_ini }}</div>
            <div class="stat-card-trend up">{{ $spj_diajukan }} diajukan</div>
            <div class="stat-card-sub">{{ $spj_disetujui }} disetujui · {{ $spj_ditolak }} ditolak</div>
        </div>
        <div class="stat-card green">
            <div class="stat-card-header">
                <div class="stat-card-label">Surat Aktif</div>
                <div class="stat-card-icon green">📧</div>
            </div>
            <div class="stat-card-value">{{ $total_surat_masuk + $total_surat_keluar }}</div>
            <div class="stat-card-sub">{{ $total_surat_masuk }} masuk · {{ $total_surat_keluar }} keluar</div>
        </div>
        <div class="stat-card purple">
            <div class="stat-card-header">
                <div class="stat-card-label">Total Pegawai</div>
                <div class="stat-card-icon purple">👥</div>
            </div>
            <div class="stat-card-value">{{ $total_pegawai }}</div>
            <div class="stat-card-up">{{ $pegawai_aktif }} aktif · {{ $pegawai_pengajuan_baru }} pengajuan baru</div>
            <div class="stat-card-sub">{{ $pegawai_aktif }} aktif</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-card-header">
                <div class="stat-card-label">Total Arsip</div>
                <div class="stat-card-icon amber">📁</div>
            </div>
            <div class="stat-card-value">{{ $total_arsip }}</div>
            <div class="stat-card-sub">Dokumen tersimpan</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('spj.create') }}" class="quick-action">
            <div class="quick-action-icon" style="background:var(--blue-50)">💰</div>
            <div class="quick-action-label">Buat SPJ Baru</div>
        </a>
        <a href="{{ route('surat.index') }}" class="quick-action">
            <div class="quick-action-icon" style="background:var(--green-50)">📧</div>
            <div class="quick-action-label">Input Surat Masuk</div>
        </a>
        <a href="{{ route('surat.index') }}" class="quick-action">
            <div class="quick-action-icon" style="background:var(--purple-50)">📤</div>
            <div class="quick-action-label">Buat Surat Keluar</div>
        </a>
        <a href="{{ route('pegawai.index') }}" class="quick-action">
            <div class="quick-action-icon" style="background:var(--amber-50)">👤</div>
            <div class="quick-action-label">Tambah Pegawai</div>
        </a>
        <a href="{{ route('arsip.index') }}" class="quick-action">
            <div class="quick-action-icon" style="background:#f0fdfa">📁</div>
            <div class="quick-action-label">Upload Arsip</div>
        </a>
    </div>

    <!-- SPJ Terbaru dari Database -->
    <div class="grid-asymmetric mb-22">
        <div class="table-container">
            <div class="table-toolbar">
                <div class="font-bold text-sm" style="color:var(--slate-700)">SPJ Terbaru</div>
                <span class="text-xs text-muted" style="margin-left:auto">{{ $spj_terbaru->count() }} data terakhir</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No. SPJ</th>
                        <th>Kegiatan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($spj_terbaru as $spj)
                    <tr>
                        <td><span class="mono text-navy font-semibold">{{ $spj->no_spj }}</span></td>
                        <td>
                            <div class="font-semibold">{{ $spj->kegiatan }}</div>
                            <span class="text-xs text-muted">{{ str_replace('-', ' ', $spj->jenis_kegiatan) }}</span>
                        </td>
                        <td><span class="mono font-semibold">Rp {{ number_format($spj->nominal, 0, ',', '.') }}</span></td>
                        <td>
                            @php
                                $badge = match($spj->status) {
                                    'Disetujui' => 'badge-green', 'Ditolak' => 'badge-red',
                                    'Diajukan' => 'badge-blue', 'Diverifikasi' => 'badge-amber',
                                    'Diproses' => 'badge-amber', default => 'badge-slate'
                                };
                            @endphp
                            <span class="badge {{ $badge }}">{{ $spj->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4"><div class="empty-state"><div class="empty-icon">💰</div><div class="empty-text">Belum ada SPJ</div></div></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="table-footer">
                <span>Menampilkan {{ $spj_terbaru->count() }} data</span>
                <a href="{{ route('spj.index') }}" class="text-xs font-semibold" style="color:var(--blue-500)">Lihat Semua →</a>
            </div>
        </div>

        <!-- Aktivitas Terkini -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Aktivitas Terkini</div>
                <span class="card-action text-xs text-muted">Hari ini</span>
            </div>
            @if ($aktivitas_terkini->count() > 0)
            <div class="timeline">
                @foreach ($aktivitas_terkini as $akt)
                <div class="timeline-item">
                    <div class="timeline-dot {{ $akt->warna ?? 'blue' }}"></div>
                    <div class="timeline-title">{{ $akt->judul }}</div>
                    <div class="timeline-text">{{ $akt->deskripsi }}</div>
                    <div class="timeline-time">{{ $akt->created_at->diffForHumans() }}</div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <div class="empty-text">Belum ada aktivitas</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Serapan Anggaran + Charts -->
    <div class="grid-asymmetric mb-22">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Serapan Anggaran per Divisi</div>
                <span class="text-xs text-muted">Tahun {{ date('Y') }}</span>
            </div>
            @forelse ($serapan_anggaran as $sa)
            <div class="progress">
                <div class="progress-header">
                    <span class="progress-label">{{ $sa->divisi }}</span>
                    <span class="progress-value">Rp {{ number_format($sa->realisasi, 0, ',', '.') }} / Rp {{ number_format($sa->pagu, 0, ',', '.') }}</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill blue" style="width:{{ min($sa->pagu > 0 ? round(($sa->realisasi / $sa->pagu) * 100) : 0, 100) }}%"></div>
                </div>
            </div>
            @empty
            <div class="text-sm text-muted" style="padding:16px;text-align:center">Belum ada data anggaran</div>
            @endforelse
        </div>

        <div>
            <div class="card mb-16">
                <div class="card-header">
                    <div class="card-title">Status SPJ</div>
                </div>
                <div class="chart-container" style="min-height:160px">
                    <canvas id="chartStatusSpj"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Pegawai per Divisi</div>
                </div>
                <div class="chart-container" style="min-height:160px">
                    <canvas id="chartPegawaiDivisi"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Status SPJ
    const ctx2 = document.getElementById('chartStatusSpj');
    if (ctx2) {
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chart_spj_labels ?? []) !!},
                datasets: [{
                    data: {!! json_encode($chart_spj_data ?? []) !!},
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#94a3b8'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 12, usePointStyle: true, font: { size: 10 } } }
                }
            }
        });
    }

    // Chart Pegawai per Divisi
    const ctx4 = document.getElementById('chartPegawaiDivisi');
    if (ctx4) {
        new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chart_divisi_labels ?? []) !!},
                datasets: [{
                    data: {!! json_encode($chart_divisi_data ?? []) !!},
                    backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 8, usePointStyle: true, font: { size: 9 } } }
                }
            }
        });
    }
});
</script>
@endpush