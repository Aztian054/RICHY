<!-- Notifications Panel -->
<div class="notif-overlay" id="notifOverlay" onclick="toggleNotifications()"></div>
<div class="notif-panel" id="notifPanel">
    <div class="notif-header">
        <div class="notif-header-title">🔔 Notifikasi</div>
        <div class="notif-header-actions">
            <button class="btn btn-sm btn-ghost" onclick="markAllRead()">Tandai dibaca</button>
            <button class="btn btn-sm btn-ghost" onclick="toggleNotifications()">✕</button>
        </div>
    </div>
    <div class="notif-body" id="notifBody">
        <div class="empty-state" id="notifEmpty">
            <div class="empty-icon">🔔</div>
            <div class="empty-text">Tidak ada notifikasi</div>
            <div class="empty-desc">Anda akan mendapat notifikasi saat ada aktivitas baru</div>
        </div>
    </div>
</div>