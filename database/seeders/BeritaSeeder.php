<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat kategori
        $kategori = [
            [
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Berita seputar dunia pendidikan'
            ],
            [
                'nama' => 'Prestasi',
                'slug' => 'prestasi',
                'deskripsi' => 'Berita prestasi siswa dan sekolah'
            ],
            [
                'nama' => 'Kegiatan',
                'slug' => 'kegiatan',
                'deskripsi' => 'Berita kegiatan yang diselenggarakan oleh sekolah'
            ],
            [
                'nama' => 'Informasi',
                'slug' => 'informasi',
                'deskripsi' => 'Informasi terkini dari sekolah'
            ]
        ];
        
        foreach ($kategori as $k) {
            KategoriBerita::create($k);
        }
        
        // ID kategori
        $pendidikanId = KategoriBerita::where('slug', 'pendidikan')->first()->id;
        $prestasiId = KategoriBerita::where('slug', 'prestasi')->first()->id;
        $kegiatanId = KategoriBerita::where('slug', 'kegiatan')->first()->id;
        $informasiId = KategoriBerita::where('slug', 'informasi')->first()->id;
        
        // Berita
        $berita = [
            [
                'judul' => 'Prestasi Membanggakan: Siswa SDN Medokan Ayu II Meraih Juara 1 Lomba Matematika Tingkat Kota',
                'slug' => 'prestasi-membanggakan-siswa-sdn-medokan-ayu-ii-meraih-juara-1-lomba-matematika-tingkat-kota',
                'konten' => "Siswa kelas 6 SDN Medokan Ayu II, Ananda Putri, berhasil meraih juara 1 dalam Olimpiade Matematika Tingkat Kota yang diselenggarakan pada tanggal 5 September 2023 di Gedung Balai Kota Surabaya.\n\nAnanda berhasil menyisihkan 150 peserta dari 30 sekolah dasar se-kota Surabaya. Dengan kecerdasan dan ketekunannya dalam belajar matematika, Ananda mampu menyelesaikan soal-soal dengan tingkat kesulitan tinggi dalam waktu yang telah ditentukan.\n\n\"Saya tidak menyangka bisa mendapatkan juara 1. Terima kasih kepada guru-guru yang telah membimbing saya selama ini,\" ungkap Ananda saat diwawancarai.\n\nKepala Sekolah SDN Medokan Ayu II, Bapak Ahmad Supriyadi, menyampaikan rasa bangga atas prestasi yang diraih oleh Ananda. \"Prestasi ini merupakan hasil dari kerja keras dan dedikasi dari siswa, guru pembimbing, serta dukungan dari orang tua. Kami berharap prestasi ini dapat memotivasi siswa lainnya untuk berprestasi di berbagai bidang,\" ujarnya.\n\nPara guru dan siswa SDN Medokan Ayu II memberikan sambutan yang meriah kepada Ananda saat kembali ke sekolah dengan membawa piala kejuaraan. Sekolah juga memberikan penghargaan khusus kepada Ananda atas prestasinya yang membanggakan ini.",
                'tanggal' => Carbon::now()->subDays(5),
                'penulis' => 'Tim Redaksi',
                'is_populer' => true,
                'kategori_id' => $prestasiId,
                'gambar' => null
            ],
            [
                'judul' => 'SDN Medokan Ayu II Menyelenggarakan Workshop Pembelajaran Berbasis Teknologi untuk Guru',
                'slug' => 'sdn-medokan-ayu-ii-menyelenggarakan-workshop-pembelajaran-berbasis-teknologi-untuk-guru',
                'konten' => "SDN Medokan Ayu II baru saja menyelenggarakan workshop pembelajaran berbasis teknologi untuk seluruh guru pada tanggal 10 September 2023. Workshop ini bertujuan untuk meningkatkan kompetensi guru dalam memanfaatkan teknologi untuk proses belajar mengajar.\n\nWorkshop yang berlangsung selama sehari ini diikuti oleh 25 guru dari berbagai mata pelajaran. Materi yang disampaikan meliputi penggunaan aplikasi pembelajaran interaktif, pembuatan media pembelajaran digital, serta strategi pengajaran menggunakan teknologi informasi.\n\n\"Di era digital seperti sekarang, guru perlu terus memperbarui pengetahuan dan keterampilan mereka dalam memanfaatkan teknologi untuk pembelajaran. Workshop ini diharapkan dapat membantu para guru mengintegrasikan teknologi dalam kegiatan belajar mengajar sehingga pembelajaran menjadi lebih menarik dan efektif,\" kata Kepala Sekolah dalam sambutannya.\n\nPara peserta workshop memberikan respon positif terhadap kegiatan ini. \"Saya mendapatkan banyak pengetahuan baru tentang aplikasi-aplikasi yang bisa digunakan untuk membuat pembelajaran jadi lebih interaktif. Anak-anak pasti akan lebih tertarik dengan metode pembelajaran seperti ini,\" tutur Ibu Siti, salah satu guru kelas 4.\n\nWorkshop ini merupakan bagian dari program pengembangan profesionalisme guru yang rutin dilaksanakan oleh SDN Medokan Ayu II. Sekolah berkomitmen untuk terus meningkatkan kualitas pendidikan melalui pengembangan kompetensi para pendidik.",
                'tanggal' => Carbon::now()->subDays(10),
                'penulis' => 'Admin Sekolah',
                'is_populer' => true,
                'kategori_id' => $pendidikanId,
                'gambar' => null
            ],
            [
                'judul' => 'Peringatan Hari Kemerdekaan ke-78 di SDN Medokan Ayu II Berlangsung Meriah',
                'slug' => 'peringatan-hari-kemerdekaan-ke-78-di-sdn-medokan-ayu-ii-berlangsung-meriah',
                'konten' => "SDN Medokan Ayu II memperingati Hari Kemerdekaan Republik Indonesia ke-78 dengan berbagai kegiatan yang berlangsung meriah. Rangkaian kegiatan dimulai dengan upacara bendera pada pagi hari, dilanjutkan dengan lomba-lomba tradisional yang diikuti oleh seluruh siswa.\n\nUpacara bendera dipimpin langsung oleh Kepala Sekolah, Bapak Ahmad Supriyadi, dan diikuti dengan khidmat oleh seluruh warga sekolah. \"Peringatan Hari Kemerdekaan ini merupakan momen penting untuk menanamkan nilai-nilai kebangsaan dan cinta tanah air kepada para siswa sejak dini,\" ujar Kepala Sekolah dalam amanatnya.\n\nSetelah upacara, berbagai lomba tradisional digelar seperti lomba makan kerupuk, balap karung, tarik tambang, dan estafet kelereng. Siswa-siswi dari kelas 1 hingga kelas 6 antusias mengikuti lomba-lomba tersebut. Suasana riuh dan semangat terlihat jelas di halaman sekolah yang dihiasi dengan hiasan merah putih.\n\n\"Lomba-lomba ini tidak hanya memberikan kegembiraan kepada anak-anak, tetapi juga mengajarkan nilai-nilai seperti sportivitas, kerja sama, dan pantang menyerah,\" kata Ibu Dewi, salah satu panitia kegiatan.\n\nDi akhir acara, pembagian hadiah diberikan kepada para pemenang lomba, dan ditutup dengan makan bersama. Kegiatan peringatan Hari Kemerdekaan ini menjadi salah satu kegiatan tahunan yang selalu dinantikan oleh seluruh warga SDN Medokan Ayu II.",
                'tanggal' => Carbon::now()->subDays(20),
                'penulis' => 'Panitia HUT RI',
                'is_populer' => false,
                'kategori_id' => $kegiatanId,
                'gambar' => null
            ],
            [
                'judul' => 'Program Literasi SDN Medokan Ayu II: Mendorong Minat Baca Siswa',
                'slug' => 'program-literasi-sdn-medokan-ayu-ii-mendorong-minat-baca-siswa',
                'konten' => "SDN Medokan Ayu II meluncurkan program literasi \"Gemar Membaca\" yang bertujuan untuk meningkatkan minat baca siswa. Program ini dilaksanakan setiap hari dengan mengalokasikan 15 menit sebelum kegiatan belajar mengajar dimulai untuk membaca buku.\n\nSelain kegiatan membaca rutin, sekolah juga mengadakan berbagai kegiatan pendukung seperti kunjungan ke perpustakaan sekolah, storytelling, dan lomba membuat sinopsis. Perpustakaan sekolah juga diperkaya dengan koleksi buku-buku baru yang menarik dan sesuai dengan usia siswa.\n\n\"Minat baca siswa perlu ditumbuhkan sejak dini. Melalui program literasi ini, kami berharap siswa dapat memperoleh manfaat dari kegiatan membaca, seperti menambah pengetahuan, memperkaya kosakata, dan mengembangkan imajinasi,\" kata Ibu Lina, koordinator program literasi.\n\nProgram yang telah berjalan selama satu bulan ini mendapat respons positif dari siswa. \"Saya suka membaca buku cerita, apalagi yang ada gambarnya. Sekarang saya jadi lebih senang pergi ke perpustakaan,\" tutur Rafa, siswa kelas 3.\n\nOrang tua siswa juga mendukung program ini. \"Anak saya jadi lebih sering meminta untuk dibelikan buku cerita. Ini perubahan yang positif. Saya sangat mendukung program literasi di sekolah,\" kata Ibu Rina, orang tua siswa.\n\nSDN Medokan Ayu II berharap program literasi ini dapat terus berjalan dan berkembang, sehingga dapat menciptakan generasi yang gemar membaca dan berwawasan luas.",
                'tanggal' => Carbon::now()->subDays(15),
                'penulis' => 'Tim Literasi Sekolah',
                'is_populer' => true,
                'kategori_id' => $pendidikanId,
                'gambar' => null
            ],
            [
                'judul' => 'Penerimaan Rapor Semester Ganjil Tahun Ajaran 2023/2024',
                'slug' => 'penerimaan-rapor-semester-ganjil-tahun-ajaran-2023-2024',
                'konten' => "SDN Medokan Ayu II akan menyelenggarakan penerimaan rapor semester ganjil tahun ajaran 2023/2024 pada hari Sabtu, 16 Desember 2023. Kegiatan ini akan berlangsung dari pukul 08.00 hingga 12.00 WIB di masing-masing ruang kelas.\n\nPenerimaan rapor akan dilakukan langsung oleh wali kelas kepada orang tua/wali murid, dengan jadwal sebagai berikut:\n- Kelas 1: 08.00 - 09.00 WIB\n- Kelas 2: 09.00 - 10.00 WIB\n- Kelas 3: 10.00 - 11.00 WIB\n- Kelas 4-6: 11.00 - 12.00 WIB\n\nSelain penerimaan rapor, orang tua/wali murid juga akan mendapatkan informasi mengenai perkembangan siswa dan program sekolah untuk semester berikutnya. Pihak sekolah mengharapkan kehadiran orang tua/wali murid tepat waktu sesuai jadwal yang telah ditentukan.\n\n\"Pertemuan dengan orang tua/wali murid pada saat penerimaan rapor ini merupakan kesempatan penting untuk menjalin komunikasi antara sekolah dan keluarga. Kami berharap dapat berdiskusi tentang perkembangan siswa dan bagaimana kita dapat bekerja sama untuk mendukung pendidikan mereka,\" kata Kepala Sekolah.\n\nOrang tua/wali murid diharapkan membawa kartu keluarga dan buku penghubung siswa. Untuk informasi lebih lanjut, dapat menghubungi wali kelas masing-masing atau sekretariat sekolah.",
                'tanggal' => Carbon::now()->subDays(2),
                'penulis' => 'Admin Sekolah',
                'is_populer' => false,
                'kategori_id' => $informasiId,
                'gambar' => null
            ],
        ];
        
        foreach ($berita as $b) {
            Berita::create($b);
        }
    }
} 