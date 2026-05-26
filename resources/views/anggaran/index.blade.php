@extends('layouts.app')
@section('title', 'Anggaran — RICH ERP')
@section('page_title', 'Anggaran')
@section('page_subtitle', 'Monitoring DIPA dan realisasi anggaran')
@section('content')
<div class="stats-grid">
    <div class="stat-card blue"><div class="stat-card-header"><div class="stat-card-label">Total Pagu</div><div class="stat-card-icon blue">📋</div></div><div class="stat-card-value">Rp {{ number_format($total_pagu, 0, ',', '.') }}</div><div class="stat-card-sub">Tahun {{ date('Y') }}</div></div>
    <div class="stat-card green"><div class="stat-card-header"><div class="stat-card-label">Realisasi</div><div class="stat-card-icon green">✅</div></div><div class="stat-card-value">Rp {{ number_format($total_realisasi, 0, ',', '.') }}</div><div class="stat-card-trend up">{{ $persentase }}% terserap</div></div>
    <div class="stat-card amber"><div class="stat-card-header"><div class="stat-card-label">Sisa Anggaran</div><div class="stat-card-icon amber">📊</div></div><div class="stat-card-value">Rp {{ number_format($sisa_anggaran, 0, ',', '.') }}</div><div class="stat-card-sub">Sisa anggaran</div></div>
    <div class="stat-card red"><div class="stat-card-header"><div class="stat-card-label">Divisi Kritis</div><div class="stat-card-icon red">⚠️</div></div>
    @php
        $kritis = 0;
        foreach ($anggaran_list as $a) { if ($a->pagu > 0 && ($a->realisasi / $a->pagu) > 0.9) $kritis++; }
    @endphp
    <div class="stat-card-value">{{ $kritis }}</div><div class="stat-card-sub">Serapan > 90%</div></div>
</div>
<div class="grid-asymmetric mb-22">
    <div class="table-container">
        <div class="table-toolbar"><div class="font-bold text-sm">Realisasi per Divisi</div></div>
        <table>
            <thead><tr><th>Divisi</th><th>Pagu</th><th>Realisasi</th><th>Sisa</th><th>Serapan</th><th>Status</th></tr></thead>
            <tbody>
                @forelse ($anggaran_list as $a)
                    @php
                        $pct = $a->pagu > 0 ? round(($a->realisasi / $a->pagu) * 100) : 0;
                        $color = $pct > 90 ? 'red' : ($pct > 75 ? 'amber' : ($pct > 40 ? 'blue' : 'green'));
                        $status = $pct > 90 ? 'Hampir Habis' : ($pct > 75 ? 'Perlu Akselerasi' : ($pct > 40 ? 'Normal' : 'Aman'));
                    @endphp
                    <tr class="{{ $pct > 90 ? 'row-urgent' : '' }}">
                        <td class="font-semibold">{{ $a->divisi }}</td>
                        <td><span class="mono">Rp {{ number_format($a->pagu, 0, ',', '.') }}</span></td>
                        <td><span class="mono">Rp {{ number_format($a->realisasi, 0, ',', '.') }}</span></td>
                        <td><span class="mono">Rp {{ number_format($a->pagu - $a->realisasi, 0, ',', '.') }}</span></td>
                        <td>
                            <div class="flex-center" style="gap:8px">
                                <span class="font-bold" style="color:var(--{{ $color }}-600)">{{ $pct }}%</span>
                                <div class="progress-bar" style="flex:1;height:6px"><div class="progress-fill {{ $color }}" style="width:{{ $pct }}%"></div></div>
                            </div>
                        </td>
                        <td><span class="badge badge-{{ $color }}">{{ $status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6"><div class="empty-state"><div class="empty-icon">📋</div><div class="empty-text">Belum ada data anggaran</div></div></td></tr>
                @endforelse
                @if ($anggaran_list->count() > 0)
                <tr style="font-weight:700;background:var(--slate-50)">
                    <td>TOTAL</td>
                    <td><span class="mono">Rp {{ number_format($total_pagu, 0, ',', '.') }}</span></td>
                    <td><span class="mono">Rp {{ number_format($total_realisasi, 0, ',', '.') }}</span></td>
                    <td><span class="mono">Rp {{ number_format($sisa_anggaran, 0, ',', '.') }}</span></td>
                    <td><span class="font-bold" style="color:var(--amber-600)">{{ $persentase }}%</span></td>
                    <td><span class="badge badge-blue">Normal</span></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="chart-card">
        <div class="chart-card-header"><div class="chart-card-title">Tren Realisasi Bulanan</div></div>
        <div class="chart-container" style="min-height:260px"><canvas id="chartRealisasi"></canvas></div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('chartRealisasi'), {
        type: 'line', data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep'],
            datasets: [{
                label: 'Realisasi (Juta)', data: [180,240,210,280,150,320,0,0,0],
                borderColor: '#2563eb', backgroundColor: 'rgba(37,99,235,0.08)', fill: true, tension: 0.4, pointRadius: 4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { font: { size: 10 } } }, x: { grid: { display: false } } }
        }
    });
});
</script>
@endpush