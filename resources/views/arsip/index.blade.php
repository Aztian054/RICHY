@extends('layouts.app')
@section('title', 'Arsip Digital — RICH ERP')
@section('page_title', 'Arsip Digital')
@section('page_subtitle', 'Penyimpanan dokumen terpusat')
@section('content')
<div class="stats-grid">
    <div class="stat-card amber">
        <div class="stat-card-header"><div class="stat-card-label">Total Dokumen</div><div class="stat-card-icon amber">📁</div></div>
        <div class="stat-card-value">{{ $total_arsip }}</div>
        <div class="stat-card-sub">Seluruh arsip tersimpan</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-card-header"><div class="stat-card-label">Kapasitas</div><div class="stat-card-icon blue">💾</div></div>
        <div class="stat-card-value">245 MB</div>
        <div class="stat-card-sub">Dari 1 GB total</div>
    </div>
    <div class="stat-card green">
        <div class="stat-card-header"><div class="stat-card-label">Dokumen SPJ</div><div class="stat-card-icon green">💰</div></div>
        <div class="stat-card-value">{{ $arsip_spj }}</div>
        <div class="stat-card-sub">{{ $total_arsip > 0 ? round(($arsip_spj / $total_arsip) * 100) : 0 }}% dari total</div>
    </div>
    <div class="stat-card teal">
        <div class="stat-card-header"><div class="stat-card-label">Dokumen Surat</div><div class="stat-card-icon green" style="background:#f0fdfa">📧</div></div>
        <div class="stat-card-value">{{ $arsip_surat }}</div>
        <div class="stat-card-sub">{{ $total_arsip > 0 ? round(($arsip_surat / $total_arsip) * 100) : 0 }}% dari total</div>
    </div>
</div>

<div class="grid-asymmetric">
    <div class="table-container">
        <div class="table-toolbar">
            <div class="table-search"><span class="table-search-icon">🔍</span><input type="text" placeholder="Cari dokumen..."></div>
            <select class="filter-select"><option>Semua Kategori</option><option>SPJ</option><option>Surat</option><option>Laporan</option><option>SK</option><option>Teknis</option></select>
            <button class="btn btn-primary btn-sm" style="margin-left:auto">📤 Upload</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:30px"><input type="checkbox"></th>
                    <th>Nama File</th>
                    <th>Kategori</th>
                    <th>Uploader</th>
                    <th>Tgl. Upload</th>
                    <th>Ukuran</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($arsip_list as $a)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="flex-center" style="gap:8px">
                            <span style="font-size:20px">{{ $a->format_file == 'pdf' ? '📄' : ($a->format_file == 'xlsx' ? '📊' : '📎') }}</span>
                            <div>
                                <div class="font-semibold">{{ $a->nama_file }}</div>
                                <span class="text-xs text-muted">{{ $a->keterangan ?? '-' }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $katClass = match($a->kategori) {
                                'SPJ' => 'badge-blue', 'Surat' => 'badge-teal', 'Laporan' => 'badge-green',
                                'SK' => 'badge-purple', 'Teknis' => 'badge-amber', default => 'badge-slate'
                            };
                        @endphp
                        <span class="badge {{ $katClass }}">{{ $a->kategori }}</span>
                    </td>
                    <td>{{ $a->uploadedBy->name ?? '-' }}</td>
                    <td><span class="font-mono" style="font-size:12px">{{ $a->created_at->format('d/m/Y') }}</span></td>
                    <td><span class="text-sm text-muted">{{ $a->ukuran_byte > 0 ? round($a->ukuran_byte / 1024, 1) . ' KB' : '-' }}</span></td>
                    <td>
                        <div class="flex" style="gap:4px">
                            <button class="btn btn-sm btn-ghost">👁️</button>
                            <button class="btn btn-sm btn-ghost">⬇️</button>
                            <button class="btn btn-sm btn-ghost" style="color:var(--red-500)">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><div class="empty-icon">📁</div><div class="empty-text">Belum ada arsip</div></div></td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="table-footer"><span>Menampilkan {{ $total_arsip }} data</span></div>
    </div>
    <div>
        <div class="card mb-16">
            <div class="card-header"><div class="card-title">Kategori Dokumen</div></div>
            <div class="chart-container" style="min-height:200px"><canvas id="chartArsip"></canvas></div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">Penggunaan Storage</div></div>
            <div class="progress"><div class="progress-header"><span class="progress-label">PDF</span><span class="progress-value">60%</span></div><div class="progress-bar"><div class="progress-fill blue" style="width:60%"></div></div></div>
            <div class="progress"><div class="progress-header"><span class="progress-label">Spreadsheet</span><span class="progress-value">25%</span></div><div class="progress-bar"><div class="progress-fill green" style="width:25%"></div></div></div>
            <div class="progress"><div class="progress-header"><span class="progress-label">Gambar</span><span class="progress-value">15%</span></div><div class="progress-bar"><div class="progress-fill amber" style="width:15%"></div></div></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartArsip');
    if(ctx) {
        new Chart(ctx, {
            type: 'pie', data: {
                labels: ['SPJ', 'Surat', 'Laporan', 'SK', 'Teknis'],
                datasets: [{
                    data: [{{ $arsip_spj }}, {{ $arsip_surat }}, {{ $arsip_laporan }}, {{ $arsip_sk }}, {{ $arsip_teknis }}],
                    backgroundColor: ['#2563eb', '#0f766e', '#10b981', '#8b5cf6', '#f59e0b'],
                    borderWidth: 0,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { font: { size: 10 } } } } }
        });
    }
});
</script>
@endpush