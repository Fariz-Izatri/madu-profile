<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Upcoming Events (Pengumuman Mendatang)
        Event::create([
            'title' => 'Pendaftaran Siswa Baru Tahun Ajaran 2023/2024',
            'description' => 'Pendaftaran siswa baru untuk tahun ajaran 2023/2024 akan dibuka mulai tanggal 15 September 2023. Orang tua calon siswa diharapkan membawa berkas-berkas yang diperlukan seperti akta kelahiran, kartu keluarga, dan foto terbaru.',
            'date' => Carbon::now()->addDays(5),
            'time' => '08:00 - 15:00',
            'images' => [],
            'highlight_description_1' => 'Pendaftaran dapat dilakukan secara online melalui website sekolah atau datang langsung ke sekolah. Pembayaran formulir pendaftaran sebesar Rp 200.000 dapat dilakukan melalui transfer bank atau di loket pembayaran sekolah.',
            'highlight_description_2' => 'Kuota terbatas hanya untuk 60 siswa baru. Prioritas akan diberikan kepada calon siswa yang mendaftar lebih awal dan memiliki saudara kandung yang bersekolah di SDN Medokan Ayu II.',
            'is_completed' => false,
        ]);

        Event::create([
            'title' => 'Ujian Akhir Semester Ganjil',
            'description' => 'Ujian Akhir Semester Ganjil akan dilaksanakan pada tanggal 10-15 Oktober 2023. Siswa diharapkan mempersiapkan diri dengan baik dan membawa peralatan ujian yang diperlukan.',
            'date' => Carbon::now()->addDays(15),
            'time' => '07:30 - 12:00',
            'images' => [],
            'highlight_description_1' => 'Jadwal ujian dapat diunduh di website sekolah atau diambil di ruang tata usaha. Siswa wajib hadir 30 menit sebelum ujian dimulai dan mengenakan seragam sekolah lengkap.',
            'highlight_description_2' => 'Bagi siswa yang sakit, orang tua/wali diharapkan memberikan surat keterangan dokter paling lambat 1 hari setelah tanggal ujian yang tidak dapat diikuti.',
            'is_completed' => false,
        ]);

        Event::create([
            'title' => 'Pertemuan Wali Murid',
            'description' => 'Pertemuan wali murid kelas 1-6 akan diadakan untuk membahas kemajuan akademik siswa dan program sekolah untuk semester mendatang. Kehadiran wali murid sangat diharapkan.',
            'date' => Carbon::now()->addDays(30),
            'time' => '09:00 - 12:00',
            'images' => [],
            'highlight_description_1' => 'Pertemuan akan dibagi menjadi dua sesi. Sesi pertama (09:00-10:30) untuk kelas 1-3, dan sesi kedua (10:30-12:00) untuk kelas 4-6.',
            'highlight_description_2' => 'Agenda pertemuan meliputi laporan perkembangan siswa, penyampaian program sekolah, dan tanya jawab. Harap membawa buku penghubung siswa.',
            'is_completed' => false,
        ]);

        Event::create([
            'title' => 'Kegiatan Ekstrakurikuler Semester Baru',
            'description' => 'Pendaftaran kegiatan ekstrakurikuler untuk semester baru telah dibuka. Siswa dapat memilih maksimal 2 kegiatan ekstrakurikuler yang diminati.',
            'date' => Carbon::now()->addDays(45),
            'time' => '13:00 - 15:00',
            'images' => [],
            'highlight_description_1' => 'Kegiatan ekstrakurikuler yang tersedia: Pramuka, Seni Tari, Bulu Tangkis, Karate, Paduan Suara, dan Drum Band. Setiap kegiatan memiliki kuota terbatas.',
            'highlight_description_2' => 'Pendaftaran dapat dilakukan melalui wali kelas masing-masing. Kegiatan ekstrakurikuler akan dimulai pada minggu ketiga bulan depan.',
            'is_completed' => false,
        ]);

        // Completed Events (Pengumuman Selesai)
        Event::create([
            'title' => 'Upacara Peringatan Hari Kemerdekaan',
            'description' => 'Upacara peringatan Hari Kemerdekaan Indonesia ke-78 telah dilaksanakan dengan khidmat. Semua siswa, guru, dan staf sekolah mengikuti upacara dengan penuh semangat.',
            'date' => Carbon::now()->subDays(15),
            'time' => '07:30 - 09:00',
            'images' => [],
            'highlight_description_1' => 'Upacara diikuti oleh seluruh warga sekolah dengan pembina upacara Bapak Kepala Sekolah. Acara dilanjutkan dengan penampilan paduan suara dan drum band sekolah.',
            'highlight_description_2' => 'Beberapa siswa juga menerima penghargaan atas prestasi akademik dan non-akademik yang telah diraih. Terima kasih kepada semua pihak yang telah mendukung acara ini.',
            'is_completed' => true,
        ]);

        Event::create([
            'title' => 'Lomba Kebersihan Kelas',
            'description' => 'Lomba kebersihan antar kelas telah selesai dilaksanakan. Lomba ini bertujuan untuk meningkatkan kesadaran siswa tentang pentingnya menjaga kebersihan lingkungan sekolah.',
            'date' => Carbon::now()->subDays(30),
            'time' => '08:00 - 12:00',
            'images' => [],
            'highlight_description_1' => 'Kelas 5A berhasil menjadi juara pertama, diikuti oleh kelas 3B di posisi kedua, dan kelas 6C di posisi ketiga. Penilaian meliputi kerapian, kebersihan, dan kreatifitas kelas.',
            'highlight_description_2' => 'Hadiah berupa piala dan perlengkapan kebersihan kelas telah diserahkan oleh kepala sekolah. Selamat kepada para pemenang!',
            'is_completed' => true,
        ]);

        Event::create([
            'title' => 'Workshop Pelatihan Guru',
            'description' => 'Workshop pelatihan guru tentang metode pembelajaran berbasis teknologi telah dilaksanakan. Para guru antusias mengikuti pelatihan untuk meningkatkan kualitas pengajaran.',
            'date' => Carbon::now()->subDays(45),
            'time' => '09:00 - 16:00',
            'images' => [],
            'highlight_description_1' => 'Workshop dibawakan oleh pembicara dari Dinas Pendidikan dan pakar teknologi pendidikan. Materi yang disampaikan meliputi penggunaan media digital dalam pembelajaran dan evaluasi berbasis teknologi.',
            'highlight_description_2' => 'Setiap guru mendapatkan sertifikat pelatihan yang dapat digunakan untuk pengembangan karir. Terima kasih kepada semua pihak yang telah berpartisipasi.',
            'is_completed' => true,
        ]);
    }
} 