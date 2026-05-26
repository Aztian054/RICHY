# 📊 RICHY - Sistem ERP Manajemen SPJ dan Keuangan

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![License](https://img.shields.io/badge/License-Proprietary-red?style=for-the-badge)

**Enterprise Resource Planning (ERP) System** untuk Biro Perbendaharaan dan Pengelolaan Risiko (BPPMHKP)

[🚀 Fitur](#-fitur-utama) • [📖 Dokumentasi](#-dokumentasi) • [⚙️ Instalasi](#-instalasi-dan-setup) • [👥 Tim](#-tim-pengembang)

</div>

---

## 📝 Deskripsi

**RICHY** (Rich ERP System) adalah platform Enterprise Resource Planning (ERP) yang komprehensif yang dirancang khusus untuk **Biro Perbendaharaan dan Pengelolaan Risiko (BPPMHKP)**. Sistem ini mengintegrasikan berbagai modul bisnis termasuk manajemen SPJ (Surat Perjalanan Jalan), pengelolaan anggaran, administrasi surat, kepegawaian, absensi, dan arsip digital.

Dengan sistem **Role-Based Access Control (RBAC)** yang canggih dan 6-level hierarki organisasi, RICHY memastikan setiap pengguna memiliki akses yang tepat sesuai peran dan tanggung jawab mereka dalam organisasi.

---

## 📋 Daftar Isi

- [Deskripsi](#-deskripsi)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Struktur Direktori](#-struktur-direktori)
- [Struktur Database](#-struktur-database)
- [Instalasi dan Setup](#-instalasi-dan-setup)
- [Sistem Akun dan Role](#-sistem-akun-dan-role)
- [Dokumentasi Fitur](#-dokumentasi-fitur)
- [API Documentation](#-api-documentation)
- [Deployment](#-deployment)
- [Troubleshooting](#-troubleshooting)
- [Kontribusi](#-kontribusi)
- [Tim Pengembang](#-tim-pengembang)
- [License](#-license)

---

## ✨ Fitur Utama

### 🎯 Modul Keuangan & SPJ
- ✅ **Pengajuan SPJ** - Karyawan dapat membuat dan mengajukan SPJ baru dengan mudah
- ✅ **Tracking Real-Time** - Monitor status SPJ dari Draft → Verifikasi → Approval → Selesai
- ✅ **Approval Workflow** - Multi-level approval dengan Verifikator → Kasubbag → Kabid → Admin
- ✅ **Manajemen Anggaran** - Alokasi dan tracking anggaran per divisi
- ✅ **Upload Dokumen** - Attachment file bukti perjalanan dan dokumentasi
- ✅ **Export Laporan** - Generate laporan SPJ dalam format PDF dan Excel
- ✅ **Riwayat Perjalanan** - Arsip lengkap semua perjalanan dinas

### 📬 Modul Administrasi
- ✅ **Manajemen Surat Masuk** - Pencatatan dan routing surat masuk
- ✅ **Manajemen Surat Keluar** - Pembuatan dan distribusi surat keluar
- ✅ **Sistem Disposisi** - Penerusan surat ke pihak terkait dengan tracking
- ✅ **Arsip Digital** - Penyimpanan dan manajemen dokumen digital terstruktur
- ✅ **Pencarian Cepat** - Full-text search untuk surat dan arsip

### 👥 Modul Kepegawaian & Absensi
- ✅ **Master Data Pegawai** - CRUD pegawai dengan informasi lengkap
- ✅ **Sistem Absensi** - Input dan tracking absensi karyawan
- ✅ **Manajemen Divisi** - Organisasi struktur organisasi

### 📊 Modul Reporting & Dashboard
- ✅ **Dashboard Interaktif** - Overview statistik real-time
- ✅ **Laporan Komprehensif** - SPJ, anggaran, absensi, surat, arsip
- ✅ **Filter & Analytics** - Filter by date range, divisi, status
- ✅ **Export Multiple Format** - CSV, Excel, PDF

### 🔐 Modul Keamanan & Administrasi
- ✅ **User Management** - CRUD user dengan assign role
- ✅ **Role-Based Access Control** - 6-level hierarki dengan permission granular
- ✅ **Password Reset** - Reset password untuk user lain
- ✅ **Profile Management** - Edit profil dan ganti password
- ✅ **Audit Log** - Tracking semua aktivitas sistem
- ✅ **System Settings** - Konfigurasi aplikasi

---

## 🛠️ Teknologi yang Digunakan

### Backend Stack
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 11.x | Framework PHP utama |
| **PHP** | 8.1+ | Programming Language |
| **MySQL** | 8.0+ | Database Management System |
| **Laravel Sanctum** | 3.3+ | API Authentication & Authorization |
| **DomPDF** | 3.1+ | PDF Generation |
| **Guzzle HTTP** | 7.x | HTTP Client |

### Frontend Stack
| Teknologi | Fungsi |
|-----------|--------|
| **Blade Template** | Server-side template engine |
| **Tailwind CSS** | Utility-first CSS framework |
| **Alpine.js** | Lightweight JavaScript framework |
| **Vite** | Build tool & module bundler |
| **Bootstrap Icons** | Icon library |

### Development Tools
| Tool | Fungsi |
|------|--------|
| **Composer** | PHP dependency manager |
| **npm** | JavaScript package manager |
| **PHPUnit** | Unit testing framework |
| **Laravel Pint** | Code formatting & linting |

---

## 📁 Struktur Direktori

```
RICHY/
│
├── 📂 app/                                  # Aplikasi utama
│   ├── 📂 Console/
│   │   └── Kernel.php                      # Console kernel
│   │
│   ├── 📂 Exceptions/
│   │   └── Handler.php                     # Exception handler
│   │
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/
│   │   │   ├── AbsensiController.php        # Absensi logic
│   │   │   ├── AnggaranController.php       # Anggaran logic
│   │   │   ├── ArsipController.php          # Arsip logic
│   │   │   ├── AuthController.php           # Authentication
│   │   │   ├── DashboardController.php      # Dashboard
│   │   │   ├── LaporanController.php        # Report generation
│   │   │   ├── PegawaiController.php        # Employee management
│   │   │   ├── PengaturanController.php     # System settings
│   │   │   ├── ProfileController.php        # User profile
│   │   │   ├── SpjController.php            # SPJ management
│   │   │   └── SuratController.php          # Letter management
│   │   │
│   │   ├── 📂 Middleware/
│   │   │   ├── Authenticate.php             # Authentication check
│   │   │   ├── CheckRole.php                # Role-based access control
│   │   │   ├── EncryptCookies.php           # Cookie encryption
│   │   │   ├── TrimStrings.php              # String trimming
│   │   │   ├── TrustProxies.php             # Proxy handling
│   │   │   ├── ValidateSignature.php        # URL signature validation
│   │   │   └── VerifyCsrfToken.php          # CSRF token validation
│   │   │
│   │   ├── 📂 Requests/
│   │   │   └── [Form Request Validation]   # Request validation classes
│   │   │
│   │   └── Kernel.php                      # HTTP Kernel
│   │
│   ├── 📂 Models/
│   │   ├── User.php                        # User model (authentication)
│   │   ├── Pegawai.php                     # Employee model
│   │   ├── Spj.php                         # SPJ model
│   │   ├── SpjApprovalLog.php              # SPJ approval log
│   │   ├── SpjDokumen.php                  # SPJ document attachment
│   │   ├── Anggaran.php                    # Budget model
│   │   ├── SuratMasuk.php                  # Incoming letter model
│   │   ├── SuratKeluar.php                 # Outgoing letter model
│   │   ├── Disposisi.php                   # Letter disposition model
│   │   ├── Arsip.php                       # Archive model
│   │   └── Absensi.php                     # Attendance model
│   │
│   ├── 📂 Providers/
│   │   ├── AppServiceProvider.php           # App service provider
│   │   ├── AuthServiceProvider.php          # Auth service provider
│   │   ├── BroadcastServiceProvider.php     # Broadcasting provider
│   │   ├── EventServiceProvider.php         # Event service provider
│   │   └── RouteServiceProvider.php         # Route service provider
│   │
│   └── 📂 View/
│       └── Components/                     # Reusable view components
│
├── 📂 bootstrap/
│   ├── app.php                             # Bootstrap application
│   └── 📂 cache/                           # Cache storage
│
├── 📂 config/
│   ├── app.php                             # Application configuration
│   ├── auth.php                            # Authentication config
│   ├── broadcasting.php                    # Broadcasting config
│   ├── cache.php                           # Cache config
│   ├── cors.php                            # CORS config
│   ├── database.php                        # Database config
│   ├── filesystems.php                     # File system config
│   ├── hashing.php                         # Hashing config
│   ├── logging.php                         # Logging config
│   ├── mail.php                            # Mail config
│   ├── queue.php                           # Queue config
│   ├── sanctum.php                         # Sanctum (API auth) config
│   ├── services.php                        # Third-party services
│   ├── session.php                         # Session config
│   └── view.php                            # View config
│
├── 📂 database/
│   ├── 📂 factories/
│   │   └── UserFactory.php                 # User model factory
│   │
│   ├── 📂 migrations/
│   │   ├── *_create_users_table.php
│   │   ├── *_create_pegawais_table.php
│   │   ├── *_create_spjs_table.php
│   │   ├── *_create_surat_masuks_table.php
│   │   ├── *_create_surat_keluars_table.php
│   │   ├── *_create_disposisis_table.php
│   │   ├── *_create_arsips_table.php
│   │   ├── *_create_absensis_table.php
│   │   ├── *_create_anggarans_table.php
│   │   └── *_create_spj_approval_logs_table.php
│   │
│   └── 📂 seeders/
│       └── DatabaseSeeder.php              # Database seeding
│
├── 📂 public/
│   ├── 📂 css/
│   │   └── app.css                         # Compiled CSS
│   ├── 📂 js/
│   │   └── app.js                          # Compiled JavaScript
│   ├── index.php                           # Entry point
│   ├── robots.txt                          # SEO robots config
│   └── favicon.ico                         # Favicon
│
├── 📂 resources/
│   ├── 📂 css/
│   │   └── app.css                         # Source CSS
│   │
│   ├── 📂 js/
│   │   ├── app.js                          # Main JavaScript
│   │   └── bootstrap.js                    # Bootstrap script
│   │
│   └── 📂 views/                           # Blade templates
│       ├── 📂 layouts/
│       │   └── app.blade.php               # Main layout
│       │
│       ├── 📂 auth/
│       │   └── login.blade.php             # Login page
│       │
│       ├── 📂 dashboard/
│       │   └── index.blade.php             # Dashboard
│       │
│       ├── 📂 spj/
│       │   ├── index.blade.php             # SPJ list
│       │   └── create.blade.php            # Create SPJ
│       │
│       ├── 📂 surat/
│       │   └── index.blade.php             # Letter management
│       │
│       ├── 📂 anggaran/
│       │   └── index.blade.php             # Budget management
│       │
│       ├── 📂 arsip/
│       │   └── index.blade.php             # Archive management
│       │
│       ├── 📂 absensi/
│       │   └── index.blade.php             # Attendance management
│       │
│       ├── 📂 pegawai/
│       │   └── index.blade.php             # Employee management
│       │
│       ├── 📂 laporan/
│       │   └── index.blade.php             # Report view
│       │
│       ├── 📂 pengaturan/
│       │   └── index.blade.php             # System settings
│       │
│       ├── 📂 profile/
│       │   └── index.blade.php             # User profile
│       │
│       └── 📂 components/
│           ├── topbar.blade.php            # Top navigation bar
│           ├── sidebar.blade.php           # Side navigation menu
│           └── notification-panel.blade.php # Notifications
│
├── 📂 routes/
│   ├── web.php                             # Web routes
│   ├── api.php                             # API routes
│   ├── channels.php                        # Broadcasting channels
│   └── console.php                         # Console commands
│
├── 📂 storage/
│   ├── 📂 app/                             # Application storage
│   │   ├── 📂 public/                      # Public storage
│   │   └── uploads/                        # Uploaded files
│   │
│   ├── 📂 framework/                       # Framework files
│   │   ├── 📂 cache/                       # Cache storage
│   │   ├── 📂 sessions/                    # Session storage
│   │   └── 📂 views/                       # View cache
│   │
│   └── 📂 logs/                            # Application logs
│
├── 📂 tests/
│   ├── 📂 Feature/
│   │   └── ExampleTest.php                 # Feature tests
│   │
│   └── 📂 Unit/
│       └── ExampleTest.php                 # Unit tests
│
├── 📂 vendor/                              # Composer dependencies (NOT IN GIT)
│
├── 📄 .env.example                         # Environment variables template
├── 📄 .editorconfig                        # Editor configuration
├── 📄 .gitattributes                       # Git attributes
├── 📄 .gitignore                           # Git ignore rules
├── 📄 artisan                              # Laravel artisan command
├── 📄 composer.json                        # PHP dependencies
├── 📄 composer.lock                        # Locked PHP dependencies
├── 📄 package.json                         # JavaScript dependencies
├── 📄 package-lock.json                    # Locked JS dependencies
├── 📄 phpunit.xml                          # PHPUnit testing configuration
├── 📄 vite.config.js                       # Vite configuration
├── 📄 README.md                            # This file
├── 📄 AKUN_DAN_ROLE.md                     # Account & Role documentation
├── 📄 ALUR_DAN_FITUR_AKUN.md               # Feature & Workflow documentation
└── 📄 .github/CONTRIBUTING.md              # Contribution guidelines
```

---

## 🗄️ Struktur Database

### Entity Relationship Diagram (ERD)

```
┌─────────────────────────────────────────────────────┐
│                    Database RICHY                    │
└─────────────────────────────────────────────────────┘

┌──────────────────┐         ┌──────────────────┐
│      Users       │◄────────│    Pegawai       │
├──────────────────┤         ├──────────────────┤
│ id (PK)          │         │ id (PK)          │
│ email            │         │ user_id (FK)     │
│ password         │         │ nama             │
│ role_level       │         │ nip              │
│ created_at       │         │ divisi           │
│ updated_at       │         │ jabatan          │
└──────────────────┘         │ status           │
         │                    └──────────────────┘
         │
    ┌────┴─────┬──────────────┬──────────────┐
    │           │              │              │
┌───▼───────────┴──┐  ┌────────▼──────────┐  ┌──────┴───────────┐
│       Spj        │  │   SuratMasuk      │  │    Anggaran      │
├──────────────────┤  ├───────────────────┤  ├──────────────────┤
│ id (PK)          │  │ id (PK)           │  │ id (PK)          │
│ user_id (FK)     │  │ user_id (FK)      │  │ user_id (FK)     │
│ pegawai_id (FK)  │  │ nomor_surat       │  │ divisi           │
│ nomor_spj        │  │ tanggal_terima    │  │ tahun            │
│ tujuan           │  │ pengirim          │  │ jumlah_anggaran  │
│ keperluan        │  │ status            │  │ created_at       │
│ status_approval  │  └───────────────────┘  └──────────────────┘
│ created_at       │           │
│ updated_at       │           │
└──────────────────┘      ┌────▼──────────────┐
        │                 │  Disposisi       │
        │                 ├──────────────────┤
        │                 │ id (PK)          │
        │                 │ surat_masuk_id   │
  ┌─────▼───────────────┐ │ user_id_dari     │
  │ SpjApprovalLog      │ │ user_id_ke       │
  ├─────────────────────┤ │ catatan          │
  │ id (PK)             │ │ status           │
  │ spj_id (FK)         │ │ created_at       │
  │ user_id (FK)        │ └──────────────────┘
  │ action              │
  │ catatan             │
  │ created_at          │
  └─────────────────────┘
        │
  ┌─────▼──────────────┐     ┌──────────────────┐
  │  SpjDokumen       │     │   SuratKeluar    │
  ├─────────────────────┤     ├──────────────────┤
  │ id (PK)             │     │ id (PK)          │
  │ spj_id (FK)         │     │ user_id (FK)     │
  │ file_path           │     │ nomor_surat      │
  │ created_at          │     │ tanggal_keluar   │
  └─────────────────────┘     │ tujuan           │
                              │ perihal          │
         ┌─────────────────────┼─────────────────┐
         │                     │                 │
    ┌────▼──────────────┐  ┌──▼─────────────┐  ┌─▼──────────────┐
    │      Arsip       │  │    Absensi     │  │  Disposisi     │
    ├───────────────────┤  ├────────────────┤  │  (line 2)      │
    │ id (PK)           │  │ id (PK)        │  ├────────────────┤
    │ user_id (FK)      │  │ pegawai_id(FK) │  │ id (PK)        │
    │ judul             │  │ tanggal        │  │ surat_keluar_id│
    │ file_path         │  │ status         │  │ user_id_dari   │
    │ created_at        │  │ keterangan     │  │ user_id_ke     │
    └───────────────────┘  │ created_at     │  │ catatan        │
                           └────────────────┘  │ created_at     │
                                               └────────────────┘
```

### Tabel-Tabel Utama

#### **users**
- Primary key untuk authentication & role management
- Menyimpan email, password (hashed), dan level role

#### **pegawai**
- Master data karyawan dengan informasi lengkap
- Relasi one-to-one dengan users table

#### **spj** (Surat Perjalanan Jalan)
- Modul keuangan untuk perjalanan dinas
- Tracking approval dengan SpjApprovalLog

#### **spj_approval_logs**
- Audit trail untuk setiap approval action pada SPJ

#### **spj_dokumens**
- Storage untuk file attachment dari SPJ

#### **surat_masuk & surat_keluar**
- Manajemen surat masuk dan keluar

#### **disposisi**
- Penerusan surat ke pihak lain

#### **anggaran**
- Alokasi budget per divisi per tahun

#### **arsip**
- Repository dokumen digital

#### **absensi**
- Tracking kehadiran karyawan

---

## 🚀 Instalasi dan Setup

### Prerequisites (Prasyarat)

Pastikan sistem Anda memiliki:
- **PHP 8.1+** dengan extensions: pdo_mysql, curl, zip, mbstring, gd
- **MySQL 8.0+** atau MariaDB 10.3+
- **Composer** (PHP dependency manager)
- **Node.js 16+** dan npm
- **Git** untuk version control
- **Web Server** (Apache, Nginx, atau built-in PHP server)

### Langkah-Langkah Instalasi

#### 1️⃣ Clone Repository

```bash
git clone https://github.com/Aztian054/RICHY.git
cd RICHY
```

#### 2️⃣ Install PHP Dependencies

```bash
composer install
```

#### 3️⃣ Install JavaScript Dependencies

```bash
npm install
```

#### 4️⃣ Setup Environment Variables

```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate application key (JANGAN SKIP!)
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi:

```env
APP_NAME="RICHY ERP"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=richy_db
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (opsional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="noreply@richy.local"
```

#### 5️⃣ Create Database

```bash
# Create database terlebih dahulu di MySQL
mysql -u root -p
> CREATE DATABASE richy_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
> EXIT;
```

#### 6️⃣ Run Database Migrations & Seeding

```bash
# Run migrations
php artisan migrate

# Seed database dengan sample data
php artisan db:seed
```

#### 7️⃣ Build Frontend Assets

```bash
# Development build
npm run dev

# Production build
npm run build
```

#### 8️⃣ Start Development Server

```bash
# Option 1: Menggunakan Laravel Artisan
php artisan serve

# Option 2: Menggunakan XAMPP/Laragon (pastikan document root mengarah ke project folder)
# Buka di browser: http://localhost:8000 atau http://richy.local
```

#### 9️⃣ Verifikasi Instalasi

Buka browser dan navigasi ke `http://localhost:8000`

Login menggunakan akun sample:
- **Email:** `pegawai@bppmhkp.go.id`
- **Password:** `pegawai123`

---

## 👥 Sistem Akun dan Role

### 6-Level Hierarki Role

| Level | Role | Deskripsi | Akses |
|:-----:|------|-----------|:----:|
| **1** | Super Admin | Akses penuh sistem tanpa batasan | 🟢 100% |
| **2** | Admin | Manajemen sistem & pengaturan | 🟢 100% |
| **3** | Kabid | Approval SPJ & manajemen divisi | 🟡 80% |
| **4** | Kasubbag | Supervisor operasional subbagian | 🟡 70% |
| **5** | Verifikator | Verifikasi kelengkapan dokumen | 🟡 60% |
| **6** | Pegawai | Input data & pengajuan SPJ | 🟡 40% |

### Default Test Accounts

| Role | Email | Password | Divisi |
|------|-------|----------|--------|
| Super Admin | `superadmin@bppmhkp.go.id` | `superadmin123` | Umum |
| Admin | `admin@bppmhkp.go.id` | `admin123` | Teknis |
| Kabid | `kabid@bppmhkp.go.id` | `kabid123` | Keuangan |
| Kasubbag | `kasubbag@bppmhkp.go.id` | `kasubbag123` | Program |
| Verifikator | `verifikator@bppmhkp.go.id` | `verifikator123` | Keuangan |
| Pegawai | `pegawai@bppmhkp.go.id` | `pegawai123` | Keuangan |

### Matriks Fitur per Role

Lihat dokumentasi detail di **[ALUR_DAN_FITUR_AKUN.md](ALUR_DAN_FITUR_AKUN.md)**

---

## 📖 Dokumentasi Fitur

### 📚 Dokumentasi Lengkap

Untuk dokumentasi detail tentang fitur, workflow, dan panduan penggunaan, silakan lihat file dokumentasi berikut:

- 📖 **[ALUR_DAN_FITUR_AKUN.md](ALUR_DAN_FITUR_AKUN.md)** - Penjelasan lengkap alur kerja dan fitur untuk setiap role
- 🔐 **[AKUN_DAN_ROLE.md](AKUN_DAN_ROLE.md)** - Daftar akun test dan matriks akses role
- 📝 **[.github/CONTRIBUTING.md](.github/CONTRIBUTING.md)** - Panduan kontribusi untuk developers

### Modul-Modul Utama

#### 1. **SPJ (Surat Perjalanan Jalan)**
- Pegawai: Create, edit, submit SPJ
- Verifikator: Verifikasi kelengkapan dokumen
- Kabid: Approve atau reject SPJ
- Export: PDF dan Excel report

#### 2. **Anggaran (Budget Management)**
- Input alokasi anggaran per divisi
- Tracking penggunaan anggaran
- Laporan anggaran terpakai vs tersisa

#### 3. **Surat Masuk & Keluar**
- Pencatatan surat masuk dengan tracking
- Pembuatan surat keluar dari sistem
- Disposisi ke pihak terkait

#### 4. **Arsip Digital**
- Upload & storage dokumen
- Kategorisasi dan tagging
- Full-text search

#### 5. **Kepegawaian**
- CRUD data karyawan
- Manage divisi & departemen
- Track status pegawai

#### 6. **Absensi**
- Input kehadiran harian
- Laporan absensi per periode
- Export data absensi

#### 7. **Dashboard & Laporan**
- Overview statistik real-time
- Filter by date, divisi, status
- Generate dan export laporan

---

## 🔌 API Documentation

### Authentication

RICHY menggunakan **Laravel Sanctum** untuk API authentication.

```bash
# Login endpoint
POST /api/login
Content-Type: application/json

{
  "email": "pegawai@bppmhkp.go.id",
  "password": "pegawai123"
}
```

Response:
```json
{
  "message": "Login berhasil",
  "user": {
    "id": 6,
    "name": "Budi Santoso",
    "email": "pegawai@bppmhkp.go.id",
    "role_level": 6
  },
  "token": "1|abc123...xyz"
}
```

### API Endpoints

Gunakan token di header:
```
Authorization: Bearer {token}
```

#### SPJ Endpoints
```
GET    /api/spj                  # List all SPJ
POST   /api/spj                  # Create SPJ
GET    /api/spj/{id}             # Get SPJ detail
PUT    /api/spj/{id}             # Update SPJ
DELETE /api/spj/{id}             # Delete SPJ
POST   /api/spj/{id}/approve     # Approve SPJ
POST   /api/spj/{id}/reject      # Reject SPJ
```

#### Pegawai Endpoints
```
GET    /api/pegawai              # List pegawai
POST   /api/pegawai              # Create pegawai
GET    /api/pegawai/{id}         # Get pegawai detail
PUT    /api/pegawai/{id}         # Update pegawai
DELETE /api/pegawai/{id}         # Delete pegawai
```

#### Surat Endpoints
```
GET    /api/surat-masuk          # List surat masuk
POST   /api/surat-masuk          # Create surat masuk
GET    /api/surat-keluar         # List surat keluar
POST   /api/surat-keluar         # Create surat keluar
```

---

## 🚀 Deployment

### Prerequisites untuk Production
- VPS/Server dengan PHP 8.1+, MySQL 8.0+
- Domain name dengan SSL certificate
- SSH access ke server
- Composer dan Git installed

### Deployment Steps

#### 1. Clone ke Server
```bash
cd /var/www
git clone https://github.com/Aztian054/RICHY.git
cd RICHY
```

#### 2. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install --production
```

#### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` untuk production settings

#### 4. Database & Asset Build
```bash
php artisan migrate --force
npm run build
```

#### 5. Setup Web Server

**Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name richy.yourdomain.com;
    root /var/www/RICHY/public;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### 6. Setup SSL dengan Let's Encrypt
```bash
sudo certbot --nginx -d richy.yourdomain.com
```

#### 7. Setup Supervisor untuk Queue (optional)
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/RICHY/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/RICHY/storage/logs/worker.log
```

#### 8. Setup Cron Job
```bash
* * * * * cd /var/www/RICHY && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🐛 Troubleshooting

### Common Issues & Solutions

#### ❌ `SQLSTATE[HY000]: General error: 1030 Got error...`
```bash
# Solution: Increase MySQL max_allowed_packet
# Edit /etc/mysql/my.cnf
max_allowed_packet = 256M

# Restart MySQL
sudo systemctl restart mysql
```

#### ❌ `Class 'PDO' not found`
```bash
# Install PHP PDO extension
sudo apt-get install php8.1-mysql
# atau untuk Mac
brew install php@8.1 --with-pdo-mysql
```

#### ❌ `Permission denied` on storage directory
```bash
chmod -R 775 storage/ bootstrap/cache/
chown -R www-data:www-data storage/ bootstrap/cache/
```

#### ❌ `npm ERR! ERESOLVE unable to resolve dependency tree`
```bash
npm install --legacy-peer-deps
```

#### ❌ Blank page setelah upload
- Check Laravel logs: `tail -f storage/logs/laravel.log`
- Enable debug mode: Set `APP_DEBUG=true` di .env

---

## 📋 Testing

### Run Unit Tests
```bash
php artisan test

# Run specific test
php artisan test tests/Feature/SpjControllerTest.php

# Run dengan coverage
php artisan test --coverage
```

### Run Feature Tests
```bash
php artisan test tests/Feature/
```

---

## 🤝 Kontribusi

Terima kasih atas minat Anda untuk berkontribusi ke RICHY! 

Silakan baca panduan kontribusi lengkap di **[.github/CONTRIBUTING.md](.github/CONTRIBUTING.md)** sebelum submit pull request.

### Kontribusi Workflow

1. Fork repository
2. Buat feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

### Standar Kode

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) code style
- Gunakan Artisan Lint: `php artisan lint`
- Write tests untuk fitur baru
- Update dokumentasi jika perlu

---

## 👨‍💻 Tim Pengembang

**RICHY** dikembangkan oleh tim profesional untuk memenuhi kebutuhan manajemen enterprise di institusi pemerintah.

### Kontributor Utama
- **Development Team** - Backend & Frontend Development
- **QA Team** - Testing & Quality Assurance
- **DevOps Team** - Infrastructure & Deployment

---

## 📄 License

RICHY adalah **Proprietary Software**. 

Hak cipta © 2026 **Biro Perbendaharaan dan Pengelolaan Risiko (BPPMHKP)**

Penggunaan, duplikasi, modifikasi, dan distribusi tanpa izin tertulis secara eksplisit dari pemilik dilarang.

---

## 📞 Support & Contact

Untuk pertanyaan, bug reports, atau saran:
- 📧 Email: support@bppmhkp.go.id
- 🐛 GitHub Issues: [Report Bug](https://github.com/Aztian054/RICHY/issues)
- 💬 Discord: Join our community server (link coming soon)

---

## 🙏 Acknowledgments

- Laravel Framework Community
- PHP Community
- Open Source Contributors

---

<div align="center">

**Made with ❤️ for Enterprise Resource Planning**

[![GitHub](https://img.shields.io/badge/GitHub-View%20on%20GitHub-171515?style=for-the-badge&logo=github)](https://github.com/Aztian054/RICHY)
[![License](https://img.shields.io/badge/License-Proprietary-red?style=for-the-badge)](LICENSE)

</div>
│   └── factories/                # Model factories
│
├── config/                       # Konfigurasi aplikasi
├── storage/                      # File storage
├── public/                       # Entry point (index.php)
├── tests/                        # Unit & Feature tests
│
├── .env.example                  # Environment example
├── composer.json                 # PHP dependencies
├── package.json                  # JavaScript dependencies
├── README.md                     # File ini
├── AKUN_DAN_ROLE.md             # Dokumentasi akun & role
└── ALUR_DAN_FITUR_AKUN.md       # Dokumentasi alur & fitur
```

## 🚀 Instalasi dan Setup

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js & npm
- Git

### Langkah-Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/RICHY.git
   cd RICHY
   ```

2. **Copy Environment File**
   ```bash
   cp .env.example .env
   ```

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=richy
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Install PHP Dependencies**
   ```bash
   composer install
   ```

6. **Install JavaScript Dependencies**
   ```bash
   npm install
   ```

7. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

9. **Build Assets**
   ```bash
   npm run build
   ```

10. **Run Application**
    ```bash
    php artisan serve
    ```
    Akses di: `http://localhost:8000`

## 👥 Sistem Akun dan Role

Sistem RICHY menggunakan role-based access control dengan 4 level role:

### 1. 🔴 Super Admin
- Akses penuh ke semua fitur
- Manajemen user, role, dan permission
- System settings dan konfigurasi
- **Hak Akses**: CREATE, READ, UPDATE, DELETE (semua resource)

### 2. 🟠 Admin
- Verifikasi dan approval SPJ
- Manajemen data SPJ
- Laporan departemen
- **Hak Akses**: READ, UPDATE (SPJ), DELETE (terbatas)

### 3. 🟡 Manager
- Monitoring SPJ team
- Approval SPJ tingkat manager
- Dashboard analitik
- **Hak Akses**: READ, UPDATE (SPJ team), CREATE (SPJ)

### 4. 🟢 Karyawan
- Pengajuan SPJ
- Tracking SPJ pribadi
- Edit SPJ draft
- **Hak Akses**: CREATE (SPJ), READ (own SPJ), UPDATE (own draft)

**Baca dokumentasi lengkap:** [AKUN_DAN_ROLE.md](AKUN_DAN_ROLE.md)

## 📊 Alur Penggunaan

### Alur 1: Karyawan Submit SPJ
```
1. Karyawan login
2. Dashboard → Buat SPJ Baru
3. Isi form SPJ lengkap
4. Upload dokumentasi
5. Submit SPJ (Status: Pending)
6. Tracking via dashboard
```

### Alur 2: Admin Verifikasi
```
1. Admin login
2. Dashboard → Daftar SPJ Pending
3. Review SPJ dan dokumentasi
4. APPROVE atau REJECT
5. Notifikasi ke karyawan
```

### Alur 3: Monitoring & Report
```
1. Admin/Manager lihat dashboard
2. Filter berdasarkan tanggal, departemen, status
3. Export laporan Excel/PDF
4. Analisis trend perjalanan dinas
```

**Baca dokumentasi lengkap:** [ALUR_DAN_FITUR_AKUN.md](ALUR_DAN_FITUR_AKUN.md)

## 📖 Panduan Pengembang

### Membuat Feature Baru
```bash
# 1. Buat migration
php artisan make:migration create_feature_table

# 2. Buat model
php artisan make:model Feature

# 3. Buat controller
php artisan make:controller FeatureController --resource

# 4. Tambah route di routes/web.php
Route::resource('features', FeatureController::class);

# 5. Buat views di resources/views/feature/
```

### Testing
```bash
# Run semua tests
php artisan test

# Run specific test
php artisan test tests/Feature/SpjTest.php

# Dengan coverage
php artisan test --coverage
```

### Best Practices
- ✅ Gunakan Eloquent ORM
- ✅ Implement middleware untuk authorization
- ✅ Follow Laravel naming conventions
- ✅ Gunakan Form Requests untuk validation
- ✅ Write unit tests
- ✅ Use database transactions
- ✅ Implement proper error handling

## 🔐 Security Best Practices
- ✅ Gunakan HTTPS di production
- ✅ Keep `.env` di `.gitignore`
- ✅ Implement rate limiting
- ✅ Regular security updates
- ✅ Use Laravel Sanctum untuk API
- ✅ CSRF protection (default)
- ✅ Validate & sanitize input
- ✅ Gunakan prepared statements

## 📞 Support & Kontribusi

- 📖 **Dokumentasi**: Baca file README ini dan dokumentasi lainnya
- 🐛 **Report Bug**: Buat issue dengan template Bug Report
- 💡 **Feature Request**: Buat issue dengan template Feature Request
- 🤝 **Contribute**: Baca [.github/CONTRIBUTING.md](.github/CONTRIBUTING.md)

---

**Versi**: 1.0.0  
**Last Updated**: May 25, 2026  
**Status**: Active Development  
**Maintainer**: Richy Development Team