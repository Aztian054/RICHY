<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — RICH ERP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { overflow: auto; }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <!-- Left Panel — Info -->
            <div class="login-info">
                <div class="login-logo">
                    <div class="login-logo-icon">🏢</div>
                    RICH ERP
                </div>
                <div class="login-headline">
                    Sistem Informasi<br>
                    <span class="login-headline-gradient">Manajemen Terpadu</span>
                </div>
                <div class="login-desc">
                    Platform terintegrasi untuk pengelolaan keuangan, surat menyurat, kepegawaian, dan arsip digital di lingkungan BPPMHKP.
                </div>
                <div class="login-features">
                    <div class="login-feature">
                        <div class="login-feature-icon">💰</div>
                        <div class="login-feature-text"><strong>SPJ Keuangan</strong> — Pengelolaan Surat Pertanggungjawaban</div>
                    </div>
                    <div class="login-feature">
                        <div class="login-feature-icon">📧</div>
                        <div class="login-feature-text"><strong>Surat & Disposisi</strong> — Manajemen surat dan disposisi pejabat</div>
                    </div>
                    <div class="login-feature">
                        <div class="login-feature-icon">👥</div>
                        <div class="login-feature-text"><strong>Kepegawaian</strong> — Data ASN dan monitoring kehadiran</div>
                    </div>
                    <div class="login-feature">
                        <div class="login-feature-icon">📁</div>
                        <div class="login-feature-text"><strong>Arsip Digital</strong> — Penyimpanan dokumen terpusat</div>
                    </div>
                </div>
                <div class="login-tags">
                    <span class="login-tag">SPJ</span>
                    <span class="login-tag">Surat</span>
                    <span class="login-tag">Pegawai</span>
                    <span class="login-tag">Arsip</span>
                    <span class="login-tag">Anggaran</span>
                    <span class="login-tag">Laporan</span>
                </div>
                <div class="login-copyright">© {{ date('Y') }} BPPMHKP — Kementerian KP RI</div>
            </div>

            <!-- Right Panel — Form -->
            <div class="login-form">
                <div class="login-greeting">👋 Selamat Datang</div>
                <div class="login-subtext">Silakan masuk ke sistem RICH ERP BPPMHKP</div>

                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-bottom: 18px;">
                        <span class="alert-icon">⚠️</span>
                        <div class="alert-content">
                            <div class="alert-title">Login Gagal</div>
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success" style="margin-bottom: 18px;">
                        <span class="alert-icon">✅</span>
                        <div class="alert-content">{{ session('status') }}</div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Username atau Email</label>
                        <div class="login-input-wrap">
                            <span class="login-input-icon">👤</span>
                            <input type="text" name="email" class="form-input" placeholder="Masukkan email atau username" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="login-input-wrap">
                            <span class="login-input-icon">🔒</span>
                            <input type="password" name="password" class="form-input" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="login-options">
                        <label class="login-checkbox">
                            <input type="checkbox" name="remember" checked> Ingat saya di perangkat ini
                        </label>
                        <a href="#" class="login-forgot">Lupa password?</a>
                    </div>
                    <button type="submit" class="login-submit">
                        🔓 Masuk ke Sistem
                    </button>
                </form>

                <div class="login-instansi">
                    <div class="login-instansi-label">Instansi</div>
                    <div class="login-instansi-name">Badan Pengelola Pembinaan dan Monitoring Hasil Kelautan dan Perikanan</div>
                </div>
                <div class="login-version">RICH ERP v2.0 — Built with Laravel</div>
            </div>
        </div>
    </div>

    <script>
        // Toast notification helper
        function showToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            const icons = { success: '✅', error: '❌', warning: '⚠️', info: 'ℹ️' };
            const toast = document.createElement('div');
            toast.className = 'toast ' + type;
            toast.innerHTML = `
                <span class="toast-icon">${icons[type] || 'ℹ️'}</span>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">✕</button>
            `;
            container.appendChild(toast);
            setTimeout(() => { toast.style.opacity = '0'; toast.style.transform = 'translateX(100px)'; toast.style.transition = '0.3s'; setTimeout(() => toast.remove(), 300); }, 3500);
        }

        // Show login success notification after redirect
        @if (session('login_success'))
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    showToast('success', 'Login Berhasil', 'Selamat datang di RICH ERP');
                }, 500);
            });
        @endif
    </script>
</body>
</html>