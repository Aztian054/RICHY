/**
 * RICH ERP — Main JavaScript
 * Vanilla JS — No dependencies (except Chart.js via CDN)
 */

// ===== NOTIFICATIONS PANEL =====
function toggleNotifications() {
    document.getElementById('notifOverlay').classList.toggle('open');
    document.getElementById('notifPanel').classList.toggle('open');
    document.getElementById('notifDot').style.display = 'none';
}

function markAllRead() {
    const items = document.querySelectorAll('.notif-item.unread');
    items.forEach(item => {
        item.classList.remove('unread');
        item.querySelector('.notif-dot').classList.remove('unread');
        item.querySelector('.notif-dot').classList.add('read');
    });
    showToast('success', 'Selesai', 'Semua notifikasi telah ditandai dibaca');
}

// ===== TOAST NOTIFICATION SYSTEM =====
function showToast(type, title, message) {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const icons = {
        success: '✅',
        error: '❌',
        warning: '⚠️',
        info: 'ℹ️'
    };

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

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100px)';
        toast.style.transition = '0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

// ===== MODAL SYSTEM =====
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}

// Close modal on overlay click
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('open');
        document.body.style.overflow = '';
    }
});

// ===== SIDEBAR SEARCH =====
document.addEventListener('DOMContentLoaded', function() {
    const sidebarSearch = document.getElementById('sidebarSearch');
    if (sidebarSearch) {
        sidebarSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.sidebar-item');

            items.forEach(item => {
                const label = item.querySelector('span:not(.sidebar-item-icon)');
                if (label) {
                    const text = label.textContent.toLowerCase();
                    item.style.display = text.includes(query) ? 'flex' : 'none';
                }
            });
        });
    }

    // ===== TOPSBAR SEARCH =====
    const topbarSearch = document.getElementById('topbarSearch');
    if (topbarSearch) {
        topbarSearch.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query) {
                    showToast('info', 'Pencarian', 'Hasil untuk: "' + query + '"');
                }
            }
        });
    }

    // ===== AUTO-CLOSE ALERTS =====
    document.querySelectorAll('.alert .alert-close').forEach(btn => {
        btn.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });

    // ===== SIDEBAR ACTIVE STATE =====
    const currentPath = window.location.pathname;
    document.querySelectorAll('.sidebar-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentPath.startsWith(href) && href !== '/') {
            item.classList.add('active');
        } else if (href === '/' && currentPath === '/') {
            item.classList.add('active');
        }
    });
});

// ===== FORMAT RUPIAH =====
function formatRupiah(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount);
}

// ===== DATE HELPER =====
function timeAgo(dateString) {
    const now = new Date();
    const date = new Date(dateString);
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMins / 60);
    const diffDays = Math.floor(diffHours / 24);

    if (diffMins < 1) return 'Baru saja';
    if (diffMins < 60) return diffMins + ' menit yang lalu';
    if (diffHours < 24) return diffHours + ' jam yang lalu';
    if (diffDays < 7) return diffDays + ' hari yang lalu';
    return date.toLocaleDateString('id-ID');
}

// ===== SIDEBAR LOGOUT CONFIRM =====
document.querySelectorAll('.sidebar-logout').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Yakin ingin logout?')) {
            e.preventDefault();
        }
    });
});