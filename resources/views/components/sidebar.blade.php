<nav class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon">🏢</div>
        <div>
            <div class="sidebar-logo-text">RICH ERP</div>
            <div class="sidebar-logo-version">v2.0 — BPPMHKP</div>
        </div>
    </div>

    <!-- Search -->
    <div class="sidebar-search">
        <span class="sidebar-search-icon">🔍</span>
        <input type="text" placeholder="Cari menu..." id="sidebarSearch">
    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-menu">
        @php
            $currentRoute = request()->route() ? request()->route()->getName() : '';
            
            $menus = [
                'UTAMA' => [
                    ['label' => 'Dashboard', 'icon' => '📊', 'route' => 'dashboard', 'active' => request()->routeIs('dashboard')],
                ],
                'KEUANGAN' => [
                    ['label' => 'SPJ Keuangan', 'icon' => '💰', 'route' => 'spj.index', 'active' => request()->routeIs('spj*'), 'badge' => \App\Models\Spj::whereIn('status', ['Diajukan', 'Diverifikasi'])->count()],
                    ['label' => 'Anggaran', 'icon' => '📋', 'route' => 'anggaran.index', 'active' => request()->routeIs('anggaran*')],
                ],
                'ADMINISTRASI' => [
                    ['label' => 'Surat & Disposisi', 'icon' => '📧', 'route' => 'surat.index', 'active' => request()->routeIs('surat*'), 'badge' => \App\Models\SuratMasuk::where('status', 'Belum-Disposisi')->count()],
                    ['label' => 'Arsip Digital', 'icon' => '📁', 'route' => 'arsip.index', 'active' => request()->routeIs('arsip*')],
                ],
                'SDM' => [
                    ['label' => 'Kepegawaian', 'icon' => '👥', 'route' => 'pegawai.index', 'active' => request()->routeIs('pegawai*'), 'badge' => \App\Models\Pegawai::where('status', 'Pengajuan-Baru')->count()],
                    ['label' => 'Absensi', 'icon' => '📅', 'route' => 'absensi.index', 'active' => request()->routeIs('absensi*')],
                ],
                'SISTEM' => [
                    ['label' => 'Laporan', 'icon' => '📈', 'route' => 'laporan.index', 'active' => request()->routeIs('laporan*')],
                    ['label' => 'Profile', 'icon' => '👤', 'route' => 'profile.index', 'active' => request()->routeIs('profile*')],
                    ['label' => 'Pengaturan', 'icon' => '⚙️', 'route' => 'pengaturan.index', 'active' => request()->routeIs('pengaturan*')],
                ],
            ];
        @endphp

        @foreach ($menus as $section => $items)
            <div class="sidebar-section">
                <div class="sidebar-section-label">{{ $section }}</div>
                @foreach ($items as $item)
                    @php $href = route($item['route']); @endphp
                    <a href="{{ $href }}" class="sidebar-item {{ $item['active'] ? 'active' : '' }}">
                        <span class="sidebar-item-icon">{{ $item['icon'] }}</span>
                        <span>{{ $item['label'] }}</span>
                        @if (isset($item['badge']))
                            <span class="sidebar-item-badge" id="badge-{{ Str::slug($item['label']) }}">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- User Footer -->
    @auth
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">{{ substr(auth()->user()->name, 0, 2) }}</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-role">{{ auth()->user()->level_name ?? 'Pegawai' }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="sidebar-logout" onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" title="Logout">🚪</button>
            </form>
        </div>
    </div>
    @endauth
</nav>