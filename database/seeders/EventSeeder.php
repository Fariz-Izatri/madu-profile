<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Upcoming Events
        Event::create([
            'title' => 'Pendaftaran Siswa Baru Tahun Ajaran 2023/2024',
            'slug' => 'pendaftaran-siswa-baru-tahun-ajaran-2023-2024',
            'description' => 'Pendaftaran siswa baru untuk tahun ajaran 2023/2024 akan dibuka mulai tanggal 15 September 2023. Orang tua calon siswa diharapkan membawa berkas-berkas yang diperlukan seperti akta kelahiran, kartu keluarga, dan foto terbaru. Pendaftaran dapat dilakukan secara online melalui website sekolah atau datang langsung ke sekolah. Pembayaran formulir pendaftaran sebesar Rp 200.000 dapat dilakukan melalui transfer bank atau di loket pembayaran sekolah. Kuota terbatas hanya untuk 60 siswa baru. Prioritas akan diberikan kepada calon siswa yang mendaftar lebih awal dan memiliki saudara kandung yang bersekolah di SDN Medokan Ayu II.',
            'event_date' => Carbon::now()->addDays(5),
            'event_time' => '08:00:00',
            'location' => 'Aula Sekolah',
            'image' => '/images/events/pendaftaran.jpg',
            'is_featured' => true,
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Ujian Akhir Semester Ganjil',
            'slug' => 'ujian-akhir-semester-ganjil',
            'description' => 'Ujian Akhir Semester Ganjil akan dilaksanakan pada tanggal 10-15 Oktober 2023. Siswa diharapkan mempersiapkan diri dengan baik dan membawa peralatan ujian yang diperlukan. Jadwal ujian dapat diunduh di website sekolah atau diambil di ruang tata usaha. Siswa wajib hadir 30 menit sebelum ujian dimulai dan mengenakan seragam sekolah lengkap. Bagi siswa yang sakit, orang tua/wali diharapkan memberikan surat keterangan dokter paling lambat 1 hari setelah tanggal ujian yang tidak dapat diikuti.',
            'event_date' => Carbon::now()->addDays(15),
            'event_time' => '07:30:00',
            'location' => 'Ruang Kelas',
            'image' => '/images/events/ujian.jpg',
            'is_featured' => false,
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Pertemuan Wali Murid',
            'slug' => 'pertemuan-wali-murid',
            'description' => 'Pertemuan wali murid kelas 1-6 akan diadakan untuk membahas kemajuan akademik siswa dan program sekolah untuk semester mendatang. Kehadiran wali murid sangat diharapkan. Pertemuan akan dibagi menjadi dua sesi. Sesi pertama (09:00-10:30) untuk kelas 1-3, dan sesi kedua (10:30-12:00) untuk kelas 4-6. Agenda pertemuan meliputi laporan perkembangan siswa, penyampaian program sekolah, dan tanya jawab. Harap membawa buku penghubung siswa.',
            'event_date' => Carbon::now()->addDays(30),
            'event_time' => '09:00:00',
            'location' => 'Aula Sekolah',
            'image' => '/images/events/pertemuan.jpg',
            'is_featured' => true,
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Kegiatan Ekstrakurikuler Semester Baru',
            'slug' => 'kegiatan-ekstrakurikuler-semester-baru',
            'description' => 'Pendaftaran kegiatan ekstrakurikuler untuk semester baru telah dibuka. Siswa dapat memilih maksimal 2 kegiatan ekstrakurikuler yang diminati. Kegiatan ekstrakurikuler yang tersedia: Pramuka, Seni Tari, Bulu Tangkis, Karate, Paduan Suara, dan Drum Band. Setiap kegiatan memiliki kuota terbatas. Pendaftaran dapat dilakukan melalui wali kelas masing-masing. Kegiatan ekstrakurikuler akan dimulai pada minggu ketiga bulan depan.',
            'event_date' => Carbon::now()->addDays(45),
            'event_time' => '13:00:00',
            'location' => 'Ruang Ekstrakurikuler',
            'image' => '/images/events/ekstrakurikuler.jpg',
            'is_featured' => false,
            'is_active' => true,
        ]);

        // Completed Events
        Event::create([
            'title' => 'Upacara Peringatan Hari Kemerdekaan',
            'slug' => 'upacara-peringatan-hari-kemerdekaan',
            'description' => 'Upacara peringatan Hari Kemerdekaan Indonesia ke-78 telah dilaksanakan dengan khidmat. Semua siswa, guru, dan staf sekolah mengikuti upacara dengan penuh semangat. Upacara diikuti oleh seluruh warga sekolah dengan pembina upacara Bapak Kepala Sekolah. Acara dilanjutkan dengan penampilan paduan suara dan drum band sekolah. Beberapa siswa juga menerima penghargaan atas prestasi akademik dan non-akademik yang telah diraih. Terima kasih kepada semua pihak yang telah mendukung acara ini.',
            'event_date' => Carbon::now()->subDays(15),
            'event_time' => '07:30:00',
            'location' => 'Lapangan Sekolah',
            'image' => '/images/events/upacara.jpg',
            'is_featured' => false,
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Lomba Kebersihan Kelas',
            'slug' => 'lomba-kebersihan-kelas',
            'description' => 'Lomba kebersihan antar kelas telah selesai dilaksanakan. Lomba ini bertujuan untuk meningkatkan kesadaran siswa tentang pentingnya menjaga kebersihan lingkungan sekolah. Kelas 5A berhasil menjadi juara pertama, diikuti oleh kelas 3B di posisi kedua, dan kelas 6C di posisi ketiga. Penilaian meliputi kerapian, kebersihan, dan kreatifitas kelas. Hadiah berupa piala dan perlengkapan kebersihan kelas telah diserahkan oleh kepala sekolah. Selamat kepada para pemenang!',
            'event_date' => Carbon::now()->subDays(30),
            'event_time' => '08:00:00',
            'location' => 'Seluruh Ruang Kelas',
            'image' => '/images/events/lomba-kebersihan.jpg',
            'is_featured' => false,
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Workshop Pelatihan Guru',
            'slug' => 'workshop-pelatihan-guru',
            'description' => 'Workshop pelatihan guru tentang metode pembelajaran berbasis teknologi telah dilaksanakan. Para guru antusias mengikuti pelatihan untuk meningkatkan kualitas pengajaran. Workshop dibawakan oleh pembicara dari Dinas Pendidikan dan pakar teknologi pendidikan. Materi yang disampaikan meliputi penggunaan media digital dalam pembelajaran dan evaluasi berbasis teknologi. Setiap guru mendapatkan sertifikat pelatihan yang dapat digunakan untuk pengembangan karir. Terima kasih kepada semua pihak yang telah berpartisipasi.',
            'event_date' => Carbon::now()->subDays(45),
            'event_time' => '09:00:00',
            'location' => 'Ruang Multimedia',
            'image' => '/images/events/workshop.jpg',
            'is_featured' => true,
            'is_active' => true,
        ]);
    }
} 