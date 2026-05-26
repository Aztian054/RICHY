<header class="topbar">
    <!-- Breadcrumb -->
    <div class="topbar-breadcrumb">
        <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
        <div class="topbar-subtitle">@yield('page_subtitle', 'Ringkasan sistem RICH ERP')</div>
    </div>

    <!-- Date -->
    <div class="topbar-date" id="topbarDate">
        @php
            setlocale(LC_TIME, 'id_ID');
            $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $now = now();
            $hariNama = $hari[$now->dayOfWeek];
            $bulanNama = $bulan[$now->month - 1];
        @endphp
        📅 {{ $hariNama }}, {{ $now->format('d') }} {{ $bulanNama }} {{ $now->format('Y') }}
    </div>

    <!-- Search -->
    <div class="topbar-search">
        <span class="topbar-search-icon">🔍</span>
        <input type="text" placeholder="Cari..." id="topbarSearch">
    </div>

    <!-- Actions -->
    <div class="topbar-actions">
        <button class="topbar-btn" onclick="toggleNotifications()" title="Notifikasi">
            🔔
            <span class="topbar-btn-dot" id="notifDot"></span>
        </button>
        <a href="{{ route('pengaturan.index') }}" class="topbar-btn" title="Pengaturan">⚙️</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="topbar-btn" title="Logout">🚪</button>
        </form>
    </div>
</header>