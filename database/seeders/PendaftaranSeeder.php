<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendaftaran = [
            [
                'judul' => 'Informasi Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026',
                'deskripsi' => "Pendaftaran Peserta Didik Baru (PPDB) untuk Tahun Ajaran 2025/2026 akan dilaksanakan pada tanggal 1-15 Juni 2025.\n\nPersyaratan pendaftaran:\n1. Usia minimal 6 tahun pada tanggal 1 Juli 2025\n2. Fotokopi akte kelahiran\n3. Fotokopi Kartu Keluarga\n4. Fotokopi KTP orang tua/wali\n5. Pas foto 3x4 berwarna (4 lembar)\n\nProses pendaftaran dapat dilakukan secara online melalui website ppdb.sdn-medokanayu2.sch.id atau langsung datang ke sekolah pada jam kerja (08.00-15.00 WIB).\n\nUntuk informasi lebih lanjut, silakan menghubungi panitia PPDB di nomor (031) 8782xxx atau email ke info@sdn-medokanayu2.sch.id.",
                'tanggal' => Carbon::create(2025, 3, 15),
                'tahun_ajaran' => '2025/2026',
                'is_active' => true,
            ],
            [
                'judul' => 'Informasi Pendaftaran Peserta Didik Baru Tahun Ajaran 2024/2025',
                'deskripsi' => "Pendaftaran Peserta Didik Baru (PPDB) untuk Tahun Ajaran 2024/2025 akan dilaksanakan pada tanggal 1-15 Juni 2024.\n\nPersyaratan pendaftaran:\n1. Usia minimal 6 tahun pada tanggal 1 Juli 2024\n2. Fotokopi akte kelahiran\n3. Fotokopi Kartu Keluarga\n4. Fotokopi KTP orang tua/wali\n5. Pas foto 3x4 berwarna (4 lembar)\n\nProses pendaftaran dapat dilakukan secara online melalui website ppdb.sdn-medokanayu2.sch.id atau langsung datang ke sekolah pada jam kerja (08.00-15.00 WIB).\n\nUntuk informasi lebih lanjut, silakan menghubungi panitia PPDB di nomor (031) 8782xxx atau email ke info@sdn-medokanayu2.sch.id.",
                'tanggal' => Carbon::create(2024, 3, 10),
                'tahun_ajaran' => '2024/2025',
                'is_active' => true,
            ],
            [
                'judul' => 'Informasi Pendaftaran Peserta Didik Baru Tahun Ajaran 2023/2024',
                'deskripsi' => "Pendaftaran Peserta Didik Baru (PPDB) untuk Tahun Ajaran 2023/2024 telah selesai dilaksanakan. Terima kasih atas partisipasi seluruh calon peserta didik dan orang tua/wali.\n\nSiswa yang diterima dapat melihat daftar nama di website sekolah atau papan pengumuman sekolah mulai tanggal 20 Juni 2023.\n\nProses daftar ulang akan dilaksanakan pada tanggal 21-25 Juni 2023 dengan membawa:\n1. Bukti pendaftaran\n2. Dokumen asli yang telah disebutkan pada saat pendaftaran\n\nUntuk informasi lebih lanjut, silakan menghubungi sekretariat sekolah di nomor (031) 8782xxx pada jam kerja.",
                'tanggal' => Carbon::create(2023, 5, 15),
                'tahun_ajaran' => '2023/2024',
                'is_active' => true,
            ],
        ];
        
        foreach ($pendaftaran as $p) {
            $p['slug'] = Str::slug($p['judul']);
            Pendaftaran::create($p);
        }
    }
} 