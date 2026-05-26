@extends('layouts.app')
@section('title', 'Laporan & Analitik — RICH ERP')
@section('page_title', 'Laporan & Analitik')
@section('page_subtitle', 'Agregasi data seluruh modul')
@section('content')
<div class="card mb-22">
    <div class="flex-center" style="gap:12px;flex-wrap:wrap">
        <div class="form-group" style="margin:0;min-width:200px">
            <label class="form-label">Periode</label>
            <select class="form-input form-input-sm">
                <option>Januari 2026</option><option>Februari 2026</option><option>Maret 2026</option>
                <option selected>Tahun {{ date('Y') }}</option>
            </select>
        </div>
        <button class="btn btn-primary" style="margin-top:18px">🔄 Generate Laporan</button>
    </div>
</div>

<div class="grid-3 mb-22">
    <div class="card" style="text-align:center">
        <div style="font-size:40px;margin-bottom:8px">💰</div>
        <div class="font-bold" style="font-size:15px">Laporan SPJ Keuangan</div>
        <div class="text-sm text-muted" style="margin:8px 0 16px">Rekapitulasi SPJ, realisasi, dan status approval</div>
        <div class="flex-center" style="gap:8px;justify-content:center">
            <button class="btn btn-sm btn-primary">📄 PDF</button>
            <button class="btn btn-sm btn-success">📊 Excel</button>
        </div>
    </div>
    <div class="card" style="text-align:center">
        <div style="font-size:40px;margin-bottom:8px">📧</div>
        <div class="font-bold" style="font-size:15px">Laporan Surat Menyurat</div>
        <div class="text-sm text-muted" style="margin:8px 0 16px">Rekap surat masuk, keluar, dan disposisi per periode</div>
        <div class="flex-center" style="gap:8px;justify-content:center">
            <button class="btn btn-sm btn-primary">📄 PDF</button>
            <button class="btn btn-sm btn-success">📊 Excel</button>
        </div>
    </div>
    <div class="card" style="text-align:center">
        <div style="font-size:40px;margin-bottom:8px">👥</div>
        <div class="font-bold" style="font-size:15px">Laporan Kepegawaian</div>
        <div class="text-sm text-muted" style="margin:8px 0 16px">Data ASN, absensi, dan distribusi pegawai per divisi</div>
        <div class="flex-center" style="gap:8px;justify-content:center">
            <button class="btn btn-sm btn-primary">📄 PDF</button>
            <button class="btn btn-sm btn-success">📊 Excel</button>
        </div>
    </div>
</div>

<div class="grid-asymmetric mb-22">
    <div class="chart-card">
        <div class="chart-card-header"><div class="chart-card-title">Tren SPJ Bulanan</div></div>
        <div class="chart-container" style="min-height:220px"><canvas id="chartTrenSpj"></canvas></div>
    </div>
    <div class="chart-card">
        <div class="chart-card-header"><div class="chart-card-title">Anggaran vs Realisasi</div></div>
        <div class="chart-container" style="min-height:220px"><canvas id="chartAnggaranLaporan"></canvas></div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('chartTrenSpj'), {
        type: 'line', data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
            datasets: [
                { label: 'Diajukan', data: [15,20,18,25,22,28], borderColor: '#2563eb', tension: 0.4, fill: false },
                { label: 'Disetujui', data: [12,16,14,20,18,24], borderColor: '#10b981', tension: 0.4, fill: false },
                { label: 'Ditolak', data: [3,4,3,5,2,4], borderColor: '#ef4444', tension: 0.4, fill: false }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { font: { size: 10 } } } } }
    });
    new Chart(document.getElementById('chartAnggaranLaporan'), {
        type: 'bar', data: {
            labels: ['Keuangan','Umum','Program','SDM','Teknis'],
            datasets: [
                { label: 'Anggaran', data: [500,350,400,250,600], backgroundColor: 'rgba(37,99,235,0.5)', borderRadius: 4 },
                { label: 'Realisasi', data: [225,217,312,88,546], backgroundColor: 'rgba(5,150,105,0.7)', borderRadius: 4 }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { font: { size: 10 } } } } }
    });
});
</script>
@endpush