<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Spj;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Arsip;
use App\Models\Anggaran;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Create Users for Each Role =====
        $users = [
            ['name' => 'Super Admin',    'email' => 'superadmin@bppmhkp.go.id',    'password' => 'superadmin123',    'level' => 1, 'instansi' => 'BPPMHKP'],
            ['name' => 'Admin BPPMHKP',  'email' => 'admin@bppmhkp.go.id',         'password' => 'admin123',         'level' => 2, 'instansi' => 'BPPMHKP'],
            ['name' => 'Kabid Keuangan', 'email' => 'kabid@bppmhkp.go.id',         'password' => 'kabid123',         'level' => 3, 'instansi' => 'BPPMHKP'],
            ['name' => 'Kasubbag Umum',  'email' => 'kasubbag@bppmhkp.go.id',      'password' => 'kasubbag123',      'level' => 4, 'instansi' => 'BPPMHKP'],
            ['name' => 'Verifikator SPJ','email' => 'verifikator@bppmhkp.go.id',   'password' => 'verifikator123',   'level' => 5, 'instansi' => 'BPPMHKP'],
            ['name' => 'Pegawai Staff',  'email' => 'pegawai@bppmhkp.go.id',       'password' => 'pegawai123',       'level' => 6, 'instansi' => 'BPPMHKP'],
        ];

        $createdUsers = [];
        foreach ($users as $data) {
            $user = User::create([
                'name'       => $data['name'],
                'email'      => $data['email'],
                'password'   => Hash::make($data['password']),
                'instansi'   => $data['instansi'],
                'level'      => $data['level'],
                'is_active'  => true,
            ]);
            $createdUsers[] = $user;
        }

        // ===== Create Sample Pegawai =====
        // Link each user to a pegawai record
        $pegawaiData = [
            ['user_id' => $createdUsers[0]->id, 'nip' => '198001012010011000', 'nama' => 'Super Admin',          'jabatan' => 'Kepala Badan',              'divisi' => 'Umum',     'golongan' => 'IV/e', 'status_kepegawaian' => 'PNS', 'role_sistem' => 'Admin',           'status' => 'Aktif'],
            ['user_id' => $createdUsers[1]->id, 'nip' => '198501012010011001', 'nama' => 'Admin BPPMHKP',        'jabatan' => 'Administrator Sistem',      'divisi' => 'Teknis',   'golongan' => 'IV/a', 'status_kepegawaian' => 'PNS', 'role_sistem' => 'Admin',           'status' => 'Aktif'],
            ['user_id' => $createdUsers[2]->id, 'nip' => '199002152012012002', 'nama' => 'Dr. Sri Wahyuni, SE., MM.', 'jabatan' => 'Kepala Divisi Keuangan', 'divisi' => 'Keuangan', 'golongan' => 'III/d', 'status_kepegawaian' => 'PNS', 'role_sistem' => 'Kabid',           'status' => 'Aktif'],
            ['user_id' => $createdUsers[3]->id, 'nip' => '198503202010011003', 'nama' => 'Ahmad Fauzi, S.Kel., M.Si', 'jabatan' => 'Kepala Subbagian',      'divisi' => 'Program',  'golongan' => 'III/c', 'status_kepegawaian' => 'PNS', 'role_sistem' => 'Kasubbag',        'status' => 'Aktif'],
            ['user_id' => $createdUsers[4]->id, 'nip' => '199107152014042004', 'nama' => 'Rina Mariana, A.Md',   'jabatan' => 'Verifikator SPJ',           'divisi' => 'Keuangan', 'golongan' => 'III/b', 'status_kepegawaian' => 'PNS', 'role_sistem' => 'Verifikator-SPJ', 'status' => 'Aktif'],
            ['user_id' => $createdUsers[5]->id, 'nip' => '202001012022011005', 'nama' => 'Budi Santoso',         'jabatan' => 'Staff Keuangan',            'divisi' => 'Keuangan', 'golongan' => 'III/a', 'status_kepegawaian' => 'PPPK','role_sistem' => 'Pegawai',        'status' => 'Aktif'],
        ];

        foreach ($pegawaiData as $data) {
            Pegawai::create($data);
        }

        // ===== Create Sample SPJ =====
        $spjData = [
            ['no_spj' => 'SPJ-001', 'kegiatan' => 'Perjalanan Dinas Jakarta',    'jenis_kegiatan' => 'Perjalanan-Dinas', 'divisi' => 'Keuangan', 'nominal' => 5250000, 'pengaju_id' => 6, 'status' => 'Diproses',  'created_by' => $createdUsers[5]->id],
            ['no_spj' => 'SPJ-002', 'kegiatan' => 'Pengadaan ATK',               'jenis_kegiatan' => 'Pengadaan',        'divisi' => 'Umum',     'nominal' => 2850000, 'pengaju_id' => 2, 'status' => 'Disetujui', 'created_by' => $createdUsers[1]->id],
            ['no_spj' => 'SPJ-003', 'kegiatan' => 'Rapat Koordinasi',            'jenis_kegiatan' => 'Rapat',            'divisi' => 'Program',  'nominal' => 1750000, 'pengaju_id' => 4, 'status' => 'Ditolak',   'created_by' => $createdUsers[3]->id],
            ['no_spj' => 'SPJ-004', 'kegiatan' => 'Pelatihan Teknis',            'jenis_kegiatan' => 'Pelatihan',        'divisi' => 'Teknis',   'nominal' => 8400000, 'pengaju_id' => 5, 'status' => 'Diproses',  'created_by' => $createdUsers[4]->id],
            ['no_spj' => 'SPJ-005', 'kegiatan' => 'Sosialisasi Program',         'jenis_kegiatan' => 'Sosialisasi',      'divisi' => 'Program',  'nominal' => 3600000, 'pengaju_id' => 3, 'status' => 'Diajukan',  'created_by' => $createdUsers[2]->id],
        ];

        foreach ($spjData as $data) {
            Spj::create($data);
        }

        // ===== Create Sample Surat Masuk & Keluar =====
        SuratMasuk::create(['no_surat' => 'B-100/KKP/XII/2026', 'asal_surat' => 'Kementerian Kelautan dan Perikanan', 'perihal' => 'Undangan Rapat Koordinasi', 'tgl_surat' => now(), 'tgl_diterima' => now(), 'sifat' => 'Penting', 'status' => 'Belum-Disposisi', 'input_oleh' => $createdUsers[0]->id]);
        SuratMasuk::create(['no_surat' => 'B-045/DKP/II/2026', 'asal_surat' => 'Dinas Kelautan Provinsi', 'perihal' => 'Permohonan Data Hasil Tangkapan', 'tgl_surat' => now(), 'tgl_diterima' => now(), 'sifat' => 'Biasa', 'status' => 'Sudah-Disposisi', 'input_oleh' => $createdUsers[1]->id]);

        SuratKeluar::create(['no_surat' => 'B-001/BPPMHKP/I/2026', 'tujuan' => 'Kementerian KP', 'perihal' => 'Laporan Bulanan', 'tgl_surat' => now(), 'dibuat_oleh' => $createdUsers[0]->id, 'status' => 'Terkirim', 'tgl_kirim' => now()]);
        SuratKeluar::create(['no_surat' => 'B-002/BPPMHKP/I/2026', 'tujuan' => 'Dinas Kelautan Provinsi', 'perihal' => 'Undangan Sosialisasi', 'tgl_surat' => now(), 'dibuat_oleh' => $createdUsers[0]->id, 'status' => 'Draft']);

        // Disposisi
        Disposisi::create(['surat_masuk_id' => 2, 'dari_user_id' => $createdUsers[1]->id, 'kepada_user_id' => $createdUsers[3]->id, 'instruksi' => 'Mohon ditindaklanjuti dan dibuatkan laporan', 'batas_waktu' => now()->addDays(7), 'prioritas' => 'Normal', 'status' => 'Menunggu']);

        // ===== Create Sample Arsip =====
        Arsip::create(['nama_file' => 'SPJ-001_Perjalanan_Dinas.pdf', 'kategori' => 'SPJ',    'format_file' => 'pdf', 'ukuran_byte' => 245000, 'uploaded_by' => $createdUsers[0]->id]);
        Arsip::create(['nama_file' => 'Surat_Masuk_B-100.pdf',       'kategori' => 'Surat',   'format_file' => 'pdf', 'ukuran_byte' => 180000, 'uploaded_by' => $createdUsers[1]->id]);
        Arsip::create(['nama_file' => 'SK_Pengangkatan_Pegawai.pdf', 'kategori' => 'SK',      'format_file' => 'pdf', 'ukuran_byte' => 320000, 'uploaded_by' => $createdUsers[0]->id]);

        // ===== Create Sample Anggaran =====
        Anggaran::create(['divisi' => 'Keuangan', 'pagu' => 500000000, 'realisasi' => 225000000, 'tahun' => date('Y'), 'keterangan' => 'Anggaran Operasional Keuangan']);
        Anggaran::create(['divisi' => 'Umum',     'pagu' => 350000000, 'realisasi' => 217000000, 'tahun' => date('Y'), 'keterangan' => 'Anggaran Umum dan Rumah Tangga']);
        Anggaran::create(['divisi' => 'Program',  'pagu' => 400000000, 'realisasi' => 312000000, 'tahun' => date('Y'), 'keterangan' => 'Anggaran Program Kerja']);
        Anggaran::create(['divisi' => 'SDM',      'pagu' => 250000000, 'realisasi' => 88000000,  'tahun' => date('Y'), 'keterangan' => 'Anggaran Pengembangan SDM']);
        Anggaran::create(['divisi' => 'Teknis',   'pagu' => 600000000, 'realisasi' => 546000000, 'tahun' => date('Y'), 'keterangan' => 'Anggaran Teknis dan Infrastruktur']);

        echo "✅ Seeder selesai!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "  Akun untuk setiap role telah dibuat:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        foreach ($users as $u) {
            $levelNames = [1 => 'Super Admin', 2 => 'Admin', 3 => 'Kabid', 4 => 'Kasubbag', 5 => 'Verifikator', 6 => 'Pegawai'];
            echo "  {$levelNames[$u['level']]}  →  {$u['email']} / {$u['password']}\n";
        }
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    }
}