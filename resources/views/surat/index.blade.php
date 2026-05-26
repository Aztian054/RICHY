@extends('layouts.app')

@section('title', 'Surat & Disposisi — RICH ERP')
@section('page_title', 'Surat & Disposisi')
@section('page_subtitle', 'Manajemen surat masuk, keluar, dan disposisi')

@section('content')
    <!-- Alert -->
    @if ($surat_belum_disposisi > 0)
    <div class="alert alert-info">
        <span class="alert-icon">ℹ️</span>
        <div class="alert-content">
            <span class="alert-title">Perhatian!</span>
            Terdapat <strong>{{ $surat_belum_disposisi }} surat masuk</strong> yang belum didisposisi.
            @if ($surat_masuk->isNotEmpty())
            Surat tertua: {{ $surat_masuk->first()->no_surat ?? '-' }}
            @endif
        </div>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        <span class="alert-icon">✅</span>
        <div class="alert-content">{{ session('success') }}</div>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
    </div>
    @endif

    <!-- Stat Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-label">Surat Masuk</div>
                <div class="stat-card-icon blue">📥</div>
            </div>
            <div class="stat-card-value">{{ $total_surat_masuk }}</div>
            <div class="stat-card-trend down">{{ $surat_belum_disposisi }} belum disposisi</div>
            <div class="stat-card-sub">Total surat masuk tercatat</div>
        </div>
        <div class="stat-card teal">
            <div class="stat-card-header">
                <div class="stat-card-label">Surat Keluar</div>
                <div class="stat-card-icon green" style="background:#f0fdfa">📤</div>
            </div>
            <div class="stat-card-value">{{ $total_surat_keluar }}</div>
            <div class="stat-card-trend up">↑ Aktif</div>
            <div class="stat-card-sub">Total surat keluar</div>
        </div>
        <div class="stat-card purple">
            <div class="stat-card-header">
                <div class="stat-card-label">Disposisi</div>
                <div class="stat-card-icon purple">📋</div>
            </div>
            <div class="stat-card-value">{{ $total_disposisi }}</div>
            <div class="stat-card-trend up">
                {{ $disposisi_selesai > 0 ? round(($disposisi_selesai / max($total_disposisi, 1)) * 100) : 0 }}% selesai
            </div>
            <div class="stat-card-sub">{{ $disposisi_selesai }} dari {{ $total_disposisi }} disposisi</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-card-header">
                <div class="stat-card-label">Perlu Tindakan</div>
                <div class="stat-card-icon amber">⚠️</div>
            </div>
            <div class="stat-card-value">{{ $surat_belum_disposisi }}</div>
            <div class="stat-card-trend down">Belum disposisi</div>
            <div class="stat-card-sub">Surat yang memerlukan disposisi</div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs" id="suratTabs">
        <div class="tab active" data-tab="masuk" onclick="switchTab('masuk')">
            📥 Surat Masuk
            <span class="tab-count">{{ $total_surat_masuk }}</span>
        </div>
        <div class="tab" data-tab="keluar" onclick="switchTab('keluar')">
            📤 Surat Keluar
            <span class="tab-count">{{ $total_surat_keluar }}</span>
        </div>
        <div class="tab" data-tab="disposisi" onclick="switchTab('disposisi')">
            📋 Disposisi
            <span class="tab-count">{{ $total_disposisi }}</span>
        </div>
    </div>

    <!-- ===== TAB 1: SURAT MASUK ===== -->
    <div class="tab-content" id="tab-masuk">
        <div class="flex-between mb-16">
            <div></div>
            <button class="btn btn-primary" onclick="openModal('modalSuratMasuk')">➕ Tambah Surat Masuk</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width:30px"><input type="checkbox"></th>
                        <th>No. Surat</th>
                        <th>Asal Surat</th>
                        <th>Perihal</th>
                        <th>Tgl. Masuk</th>
                        <th>Sifat</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($surat_masuk as $s)
                    <tr class="{{ $s->status == 'Belum-Disposisi' ? 'row-urgent' : '' }}">
                        <td><input type="checkbox"></td>
                        <td><span class="mono text-navy font-semibold">{{ $s->no_surat }}</span></td>
                        <td>{{ $s->asal_surat }}</td>
                        <td>
                            <div class="font-semibold">{{ $s->perihal }}</div>
                            <span class="text-xs text-muted">{{ $s->kategori ?? '-' }}</span>
                        </td>
                        <td>
                            <span class="font-mono" style="font-size:12px">
                                {{ \Carbon\Carbon::parse($s->tgl_diterima)->format('d/m/Y') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $sifatClass = match($s->sifat) {
                                    'Penting' => 'badge-red',
                                    'Segera' => 'badge-amber',
                                    'Rahasia' => 'badge-purple',
                                    default => 'badge-slate'
                                };
                            @endphp
                            <span class="badge {{ $sifatClass }}">{{ $s->sifat }}</span>
                        </td>
                        <td>
                            @if ($s->status == 'Belum-Disposisi')
                                <span class="badge badge-amber">⬜ Belum Disposisi</span>
                            @elseif ($s->status == 'Sudah-Disposisi')
                                <span class="badge badge-blue">📋 Sudah Disposisi</span>
                            @else
                                <span class="badge badge-green">✅ Selesai</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex" style="gap:4px">
                                @if ($s->status == 'Belum-Disposisi')
                                    <button class="btn btn-sm btn-primary" onclick="openDisposisi({{ $s->id }}, '{{ $s->no_surat }}')">Disposisi</button>
                                @endif
                                <button class="btn btn-sm btn-ghost" onclick="lihatSurat({{ $s->id }})">👁️</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">📧</div>
                                <div class="empty-text">Belum ada surat masuk</div>
                                <div class="empty-desc">Klik "Tambah Surat Masuk" untuk menambahkan data pertama</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="table-footer">
                <span>Menampilkan {{ $surat_masuk->count() }} data</span>
            </div>
        </div>
    </div>

    <!-- ===== TAB 2: SURAT KELUAR ===== -->
    <div class="tab-content" id="tab-keluar" style="display:none">
        <div class="flex-between mb-16">
            <div></div>
            <button class="btn btn-primary" onclick="openModal('modalSuratKeluar')">➕ Buat Surat Keluar</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width:30px"><input type="checkbox"></th>
                        <th>No. Surat</th>
                        <th>Tujuan</th>
                        <th>Perihal</th>
                        <th>Tgl. Surat</th>
                        <th>Pembuat</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($surat_keluar as $s)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span class="mono text-navy font-semibold">{{ $s->no_surat }}</span></td>
                        <td>{{ $s->tujuan }}</td>
                        <td>
                            <div class="font-semibold">{{ $s->perihal }}</div>
                        </td>
                        <td><span class="font-mono" style="font-size:12px">{{ \Carbon\Carbon::parse($s->tgl_surat)->format('d/m/Y') }}</span></td>
                        <td>{{ $s->dibuatOleh->name ?? '-' }}</td>
                        <td>
                            @php
                                $statusClass = match($s->status) {
                                    'Terkirim' => 'badge-green',
                                    'Dalam-Pengiriman' => 'badge-amber',
                                    default => 'badge-slate'
                                };
                                $statusIcon = match($s->status) {
                                    'Terkirim' => '✅',
                                    'Dalam-Pengiriman' => '📤',
                                    default => '📝'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $statusIcon }} {{ $s->status }}</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-ghost">👁️</button>
                            @if ($s->status == 'Draft')
                                <button class="btn btn-sm btn-success">Kirim</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">📤</div>
                                <div class="empty-text">Belum ada surat keluar</div>
                                <div class="empty-desc">Klik "Buat Surat Keluar" untuk membuat surat baru</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="table-footer">
                <span>Menampilkan {{ $surat_keluar->count() }} data</span>
            </div>
        </div>
    </div>

    <!-- ===== TAB 3: DISPOSISI ===== -->
    <div class="tab-content" id="tab-disposisi" style="display:none">
        <div class="grid-asymmetric">
            <!-- Kolom Kiri: Tabel Disposisi -->
            <div class="table-container">
                <div class="table-toolbar">
                    <div class="font-bold text-sm" style="color:var(--slate-700)">Daftar Disposisi</div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Dari</th>
                            <th>Kepada</th>
                            <th>Instruksi</th>
                            <th>Batas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($disposisi as $d)
                        <tr>
                            <td><span class="mono text-navy font-semibold">{{ $d->suratMasuk->no_surat ?? '-' }}</span></td>
                            <td>{{ $d->dariUser->name ?? '-' }}</td>
                            <td>{{ $d->kepadaUser->name ?? '-' }}</td>
                            <td>
                                <div class="font-semibold">{{ Str::limit($d->instruksi, 40) }}</div>
                                <span class="text-xs text-muted">{{ ucfirst($d->prioritas) }}</span>
                            </td>
                            <td><span class="font-mono" style="font-size:12px">{{ \Carbon\Carbon::parse($d->batas_waktu)->format('d/m/Y') }}</span></td>
                            <td>
                                @if ($d->status == 'Selesai')
                                    <span class="badge badge-green">✅ Selesai</span>
                                @elseif ($d->status == 'Proses')
                                    <span class="badge badge-amber">⏳ Proses</span>
                                @else
                                    <span class="badge badge-blue">⬜ Menunggu</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">📋</div>
                                    <div class="empty-text">Belum ada disposisi</div>
                                    <div class="empty-desc">Disposisi akan muncul saat surat masuk diproses</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Kolom Kanan: Timeline Alur Disposisi -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Alur Disposisi</div>
                    <span class="text-xs text-muted">Realtime</span>
                </div>
                @if ($disposisi->count() > 0)
                <div class="timeline">
                    @foreach ($disposisi->take(5) as $d)
                    <div class="timeline-item">
                        <div class="timeline-dot {{ $d->status == 'Selesai' ? 'green' : ($d->status == 'Proses' ? 'amber' : 'blue') }}"></div>
                        <div class="timeline-title">Disposisi: {{ $d->suratMasuk->no_surat ?? '-' }}</div>
                        <div class="timeline-text">
                            {{ $d->dariUser->name ?? '-' }} → {{ $d->kepadaUser->name ?? '-' }}
                        </div>
                        <div class="timeline-time">{{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}</div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <div class="empty-text">Belum ada aktivitas disposisi</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH SURAT MASUK ===== -->
    <div class="modal-overlay" id="modalSuratMasuk">
        <div class="modal" style="max-width:560px">
            <div class="modal-header">
                <div class="modal-title">📥 Tambah Surat Masuk</div>
                <button class="modal-close" onclick="closeModal('modalSuratMasuk')">✕</button>
            </div>
            <form action="{{ route('surat.store.masuk') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">No. Surat</label>
                            <input type="text" name="no_surat" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Asal Surat</label>
                            <input type="text" name="asal_surat" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Perihal</label>
                        <input type="text" name="perihal" class="form-input" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal Surat</label>
                            <input type="date" name="tgl_surat" class="form-input" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Diterima</label>
                            <input type="date" name="tgl_diterima" class="form-input" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Sifat</label>
                            <select name="sifat" class="form-input" required>
                                <option value="Biasa">Biasa</option>
                                <option value="Penting">Penting</option>
                                <option value="Segera">Segera</option>
                                <option value="Rahasia">Rahasia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-input" placeholder="Opsional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalSuratMasuk')">Batal</button>
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL BUAT SURAT KELUAR ===== -->
    <div class="modal-overlay" id="modalSuratKeluar">
        <div class="modal" style="max-width:560px">
            <div class="modal-header">
                <div class="modal-title">📤 Buat Surat Keluar</div>
                <button class="modal-close" onclick="closeModal('modalSuratKeluar')">✕</button>
            </div>
            <form action="{{ route('surat.store.keluar') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">No. Surat</label>
                            <input type="text" name="no_surat" class="form-input" placeholder="B-XXX/BPPMHKP/..." required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tujuan</label>
                            <input type="text" name="tujuan" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Perihal</label>
                        <input type="text" name="perihal" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" name="tgl_surat" class="form-input" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalSuratKeluar')">Batal</button>
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL DISPOSISI ===== -->
    <div class="modal-overlay" id="modalDisposisi">
        <div class="modal" style="max-width:560px">
            <div class="modal-header">
                <div class="modal-title">📋 Disposisi Surat</div>
                <button class="modal-close" onclick="closeModal('modalDisposisi')">✕</button>
            </div>
            <form action="" method="POST" id="formDisposisi">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" class="form-input" id="disposisiNoSurat" readonly style="background:var(--slate-50)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Disposisi Kepada</label>
                        <select name="kepada_user_id" class="form-input" required>
                            <option value="">— Pilih Pejabat —</option>
                            @foreach (\App\Models\User::where('level', '<=', 4)->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->level_name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Instruksi</label>
                        <textarea name="instruksi" class="form-input form-textarea" placeholder="Tulis instruksi disposisi..." required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Batas Waktu</label>
                            <input type="date" name="batas_waktu" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prioritas</label>
                            <select name="prioritas" class="form-input" required>
                                <option value="Normal">Normal</option>
                                <option value="Penting">Penting</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalDisposisi')">Batal</button>
                    <button type="submit" class="btn btn-primary">📨 Kirim Disposisi</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// ===== TAB SYSTEM =====
function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + tabName).style.display = 'block';
    document.querySelector(`.tab[data-tab="${tabName}"]`).classList.add('active');
}

// ===== DISPOSISI MODAL =====
function openDisposisi(suratId, noSurat) {
    document.getElementById('disposisiNoSurat').value = noSurat;
    document.getElementById('formDisposisi').action = '/surat/' + suratId + '/disposisi';
    openModal('modalDisposisi');
}

// ===== LIHAT SURAT =====
function lihatSurat(id) {
    fetch('/surat/masuk/' + id)
        .then(res => res.json())
        .then(data => {
            showToast('info', 'Detail Surat', data.no_surat + ' — ' + data.perihal);
        })
        .catch(() => showToast('error', 'Gagal', 'Tidak dapat memuat detail surat'));
}

// Initial tab
document.addEventListener('DOMContentLoaded', function() {
    switchTab('masuk');
});
</script>
@endpush

<style>
.row-urgent { background-color: rgba(245, 158, 11, 0.04); }
.row-urgent td .badge-amber { background: var(--amber-50); color: var(--amber-700); }
.table-container table td { vertical-align: middle; }
</style>