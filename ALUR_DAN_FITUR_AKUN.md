# 📖 Panduan Alur & Fitur Setiap Akun — RICH ERP v2.0

Dokumen ini menjelaskan secara detail **fungsi masing-masing role**, **fitur yang dapat diakses**, serta **alur kerja (workflow)** dari setiap akun dalam sistem RICH ERP BPPMHKP.

---

## 📋 Daftar Isi

1. [Struktur Level & Hak Akses](#1-struktur-level--hak-akses)
2. [Alur Umum Sistem](#2-alur-umum-sistem)
3. [Super Admin (Level 1)](#3-super-admin-level-1)
4. [Admin (Level 2)](#4-admin-level-2)
5. [Kabid (Level 3)](#5-kabid-level-3)
6. [Kasubbag (Level 4)](#6-kasubbag-level-4)
7. [Verifikator (Level 5)](#7-verifikator-level-5)
8. [Pegawai (Level 6)](#8-pegawai-level-6)
9. [Diagram Alur Approval SPJ](#9-diagram-alur-approval-spj)
10. [Alur Disposisi Surat](#10-alur-disposisi-surat)

---

## 1. Struktur Level & Hak Akses

Sistem menggunakan 6 level hierarki. Semakin kecil angka level, semakin tinggi otoritasnya.

```
Level 1: Super Admin    → Akses penuh ke seluruh sistem
Level 2: Admin          → Manajemen sistem & pengaturan
Level 3: Kabid          → Approval tingkat kepala divisi
Level 4: Kasubbag       → Approval tingkat subbagian
Level 5: Verifikator    → Verifikasi dokumen SPJ
Level 6: Pegawai        → Input & pengajuan
```

### Matriks Fitur per Role

| Fitur / Modul | Super Admin | Admin | Kabid | Kasubbag | Verifikator | Pegawai |
|:--------------|:-----------:|:-----:|:-----:|:--------:|:-----------:|:-------:|
| **Dashboard** | ✅ Lihat semua | ✅ Lihat semua | ✅ Lihat semua | ✅ Lihat semua | ✅ Lihat semua | ✅ Lihat semua |
| **SPJ — Buat** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **SPJ — Approve** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **SPJ — Tolak** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **SPJ — Hapus** | ✅ | ✅ | ❌ | ❌ | ❌ | ❌ |
| **Anggaran — Input** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Anggaran — Lihat** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Surat Masuk — Input** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Surat Keluar — Input** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Disposisi — Kirim** | ✅ | ✅ | ✅ | ✅ | ❌ | ❌ |
| **Disposisi — Terima** | ✅ | ✅ | ✅ | ✅ | ❌ | ❌ |
| **Kepegawaian — Input** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Kepegawaian — Approve** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Absensi — Input** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Arsip — Upload** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Arsip — Hapus** | ✅ | ✅ | ❌ | ❌ | ❌ | ❌ |
| **Laporan — Lihat** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Laporan — Generate** | ✅ | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Pengaturan Sistem** | ✅ | ✅ | ❌ | ❌ | ❌ | ❌ |
| **Profile — Edit** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Profile — Ganti Password** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |

---

## 2. Alur Umum Sistem

```
                    ┌─────────────────────┐
                    │   Login (Email/User) │
                    └─────────┬───────────┘
                              │
                    ┌─────────▼───────────┐
                    │   Dashboard Utama   │
                    │   (Ringkasan data)  │
                    └─────────┬───────────┘
                              │
              ┌───────────────┼───────────────┐
              │               │               │
       ┌──────▼──────┐ ┌──────▼──────┐ ┌──────▼──────┐
       │   Modul     │ │   Modul     │ │   Modul     │
       │ Keuangan    │ │ Administrasi│ │     SDM     │
       │ • SPJ       │ │ • Surat     │ │ • Pegawai   │
       │ • Anggaran  │ │ • Arsip     │ │ • Absensi   │
       └─────────────┘ └─────────────┘ └─────────────┘
```

---

## 3. Super Admin (Level 1)

**Akses:** 🔓 Penuh — Tidak ada batasan.

### Fitur yang Didapat

| Fitur | Keterangan |
|-------|-----------|
| **Dashboard** | Melihat seluruh ringkasan data dari semua modul |
| **SPJ Keuangan** | ✅ Membuat, mengedit, menyetujui, menolak, menghapus SPJ |
| **Anggaran** | ✅ Input, edit, hapus data anggaran per divisi |
| **Surat & Disposisi** | ✅ Input surat masuk/keluar, kirim disposisi ke siapapun |
| **Arsip Digital** | ✅ Upload, download, hapus arsip |
| **Kepegawaian** | ✅ Tambah, edit, setujui pegawai baru |
| **Absensi** | ✅ Input absensi semua pegawai |
| **Laporan** | ✅ Generate & export laporan PDF/Excel |
| **Pengaturan** | ✅ Kelola user, ubah password user lain |
| **Profile** | ✅ Edit profil & ganti password sendiri |

### Kasus Penggunaan

- **Sebagai pemilik sistem:** Super Admin bisa melakukan apapun tanpa restriksi.
- **Sebagai operator darurat:** Jika admin utama tidak ada, Super Admin bisa mengambil alih tugas apa pun.
- **Monitoring penuh:** Melihat seluruh aktivitas sistem.

---

## 4. Admin (Level 2)

**Akses:** 🔓 Hampir penuh — Sama seperti Super Admin.

### Fitur yang Didapat

| Fitur | Keterangan |
|-------|-----------|
| **Dashboard** | ✅ Ringkasan seluruh data |
| **SPJ Keuangan** | ✅ CRUD + approve + reject |
| **Anggaran** | ✅ Input & edit data anggaran |
| **Surat & Disposisi** | ✅ Input surat + kirim disposisi |
| **Arsip Digital** | ✅ Upload, download, hapus |
| **Kepegawaian** | ✅ Tambah, edit, setujui pegawai |
| **Absensi** | ✅ Input absensi |
| **Laporan** | ✅ Generate laporan |
| **Pengaturan** | ✅ Kelola user & password |
| **Profile** | ✅ Edit profil & ganti password |

### Perbedaan dengan Super Admin

- Admin tidak bisa mengubah level user lain menjadi Super Admin (perlindungan sistem).

---

## 5. Kabid (Level 3)

**Akses:** 🟢 Approval & Operasional.

### Fitur yang Didapat

| Fitur | Keterangan |
|-------|-----------|
| **Dashboard** | ✅ Melihat ringkasan data |
| **SPJ Keuangan** | ✅ Membuat & mengajukan SPJ |
| | ✅ **Menyetujui** SPJ dari bawahan |
| | ✅ **Menolak** SPJ dengan alasan |
| **Anggaran** | ✅ Melihat data anggaran |
| | ✅ Input data anggaran divisi |
| **Surat & Disposisi** | ✅ Input surat masuk/keluar |
| | ✅ Kirim disposisi ke Kasubbag |
| **Arsip Digital** | ✅ Upload & download |
| **Kepegawaian** | ✅ Melihat data pegawai |
| | ✅ Menyetujui pegawai baru |
| **Absensi** | ✅ Melihat rekap absensi |
| **Laporan** | ✅ Melihat laporan |
| **Profile** | ✅ Edit profil & ganti password |

### Alur Kerja Khas

```
1. Pegawai mengajukan SPJ
2. Verifikator memverifikasi kelengkapan
3. → Kabid menyetujui atau menolak SPJ ←
4. Jika disetujui, SPJ diproses lebih lanjut
```

---

## 6. Kasubbag (Level 4)

**Akses:** 🟡 Operasional & Monitoring.

### Fitur yang Didapat

| Fitur | Keterangan |
|-------|-----------|
| **Dashboard** | ✅ Melihat ringkasan data |
| **SPJ Keuangan** | ✅ Membuat & mengajukan SPJ |
| | ❌ **Tidak bisa approve** (hanya mengajukan) |
| **Anggaran** | ✅ Melihat data anggaran |
| **Surat & Disposisi** | ✅ Input surat masuk/keluar |
| | ✅ Menerima & memproses disposisi dari Kabid |
| **Arsip Digital** | ✅ Upload & download |
| **Kepegawaian** | ✅ Melihat data pegawai |
| **Absensi** | ✅ Input absensi |
| **Laporan** | ✅ Melihat laporan |
| **Profile** | ✅ Edit profil & ganti password |

### Alur Kerja Khas

```
1. Kabid mengirim disposisi surat ke Kasubbag
2. → Kasubbag menerima disposisi & menindaklanjuti ←
3. Kasubbag melaporkan hasil disposisi ke Kabid
```

---

## 7. Verifikator (Level 5)

**Akses:** 🔵 Verifikasi Dokumen.

### Fitur yang Didapat

| Fitur | Keterangan |
|-------|-----------|
| **Dashboard** | ✅ Melihat ringkasan data |
| **SPJ Keuangan** | ✅ Membuat & mengajukan SPJ |
| | ✅ Memverifikasi kelengkapan dokumen SPJ |
| **Anggaran** | ✅ Melihat data anggaran |
| **Surat & Disposisi** | ✅ Input surat masuk/keluar |
| | ❌ **Tidak bisa kirim disposisi** |
| **Arsip Digital** | ✅ Upload & download |
| **Kepegawaian** | ✅ Melihat data pegawai |
| **Absensi** | ✅ Input absensi |
| **Laporan** | ✅ Melihat laporan |
| **Profile** | ✅ Edit profil & ganti password |

### Alur Kerja Khas

```
1. Pegawai mengajukan SPJ (status: Diajukan)
2. → Verifikator memeriksa kelengkapan ←
3. Jika lengkap → status jadi "Diverifikasi"
4. Jika tidak lengkap → Verifikator bisa memberi catatan revisi
5. Selanjutnya SPJ masuk antrian approval Kabid
```

---

## 8. Pegawai (Level 6)

**Akses:** ⚪ Dasar — Input & Pengajuan.

### Fitur yang Didapat

| Fitur | Keterangan |
|-------|-----------|
| **Dashboard** | ✅ Melihat ringkasan data (read-only) |
| **SPJ Keuangan** | ✅ **Membuat & mengajukan** SPJ baru |
| | ❌ **Tidak bisa approve/menolak** |
| | ❌ **Tidak bisa melihat semua SPJ** (hanya punya sendiri) |
| **Anggaran** | ✅ Melihat data anggaran (read-only) |
| **Surat & Disposisi** | ✅ Input surat masuk & keluar |
| **Arsip Digital** | ✅ Upload & download |
| **Kepegawaian** | ✅ Melihat data pegawai (read-only) |
| **Absensi** | ✅ Input absensi sendiri |
| **Laporan** | ✅ Melihat laporan (read-only) |
| **Profile** | ✅ Edit profil & ganti password sendiri |

### Alur Kerja Khas

```
1. Pegawai login → Dashboard
2. → Pegawai membuat SPJ baru ←
3. → Pegawai mengajukan SPJ (status: Diajukan) ←
4. SPJ masuk antrian Verifikator & Kabid
5. Pegawai memantau status SPJ di dashboard
```

---

## 9. Diagram Alur Approval SPJ

```
                    ┌──────────────┐
                    │   PEGAWAI    │
                    │  Buat SPJ    │
                    │  → Diajukan  │
                    └──────┬───────┘
                           │
                           ▼
                    ┌──────────────┐
                    │ VERIFIKATOR  │
                    │  Periksa     │
                    │  dokumen     │
                    └──────┬───────┘
                           │
              ┌────────────┼────────────┐
              │            │            │
              ▼            ▼            ▼
        ┌──────────┐ ┌──────────┐ ┌──────────┐
        │ Lengkap  │ │ Kurang   │ │ Ditolak  │
        │ → Diveri-│ │ → Kembali│ │ → Selesai│
        │   fikasi │ │   ke     │ │          │
        └────┬─────┘ │   Pegawai│ └──────────┘
             │       └──────────┘
             ▼
     ┌──────────────┐
     │    KABID     │
     │  Approve /   │
     │  Reject      │
     └──────┬───────┘
            │
     ┌──────┴──────┐
     │             │
     ▼             ▼
┌──────────┐ ┌──────────┐
│ Disetujui│ │ Ditolak  │
│ → Selesai│ │ → Selesai│
└──────────┘ └──────────┘
```

---

## 10. Alur Disposisi Surat

```
                    ┌──────────────┐
                    │   PEGAWAI    │
                    │  Input Surat │
                    │  Masuk       │
                    └──────┬───────┘
                           │
                           ▼
                    ┌──────────────┐
                    │    KABID     │
                    │  Kirim       │
                    │  Disposisi   │
                    └──────┬───────┘
                           │
                           ▼
                    ┌──────────────┐
                    │   KASUBBAG   │
                    │  Terima &    │
                    │  Proses      │
                    └──────┬───────┘
                           │
              ┌────────────┼────────────┐
              │            │            │
              ▼            ▼            ▼
        ┌──────────┐ ┌──────────┐ ┌──────────┐
        │ Selesai  │ │ Dalam    │ │ Menunggu │
        │          │ │ Proses   │ │          │
        └──────────┘ └──────────┘ └──────────┘
```

---

## 💡 Ringkasan

| Role | Level | Tagline | Bisa Approve SPJ? | Bisa Disposisi? |
|------|:-----:|---------|:------------------:|:---------------:|
| Super Admin | 1 | 🔓 Bebas akses | ✅ | ✅ |
| Admin | 2 | 🔓 Pengelola sistem | ✅ | ✅ |
| Kabid | 3 | 🟢 Decision maker | ✅ | ✅ (Kirim) |
| Kasubbag | 4 | 🟡 Pelaksana | ❌ | ✅ (Terima) |
| Verifikator | 5 | 🔵 Pemeriksa | ❌ | ❌ |
| Pegawai | 6 | ⚪ Pelapor | ❌ | ❌ |

---

> **Catatan:** Middleware `CheckRole` sudah terpasang di sistem untuk membatasi akses sesuai level masing-masing. Jika user mencoba mengakses halaman di luar levelnya, akan muncul error 403 (Forbidden).