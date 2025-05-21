<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekstrakurikuler = [
            [
                'nama' => 'Pramuka',
                'deskripsi' => "Pramuka (Praja Muda Karana) adalah kegiatan ekstrakurikuler wajib yang mengajarkan nilai-nilai kepanduan, kedisiplinan, kemandirian, kerjasama tim, dan cinta alam. Melalui berbagai aktivitas seperti berkemah, baris-berbaris, sandi, dan tali-temali, siswa dapat mengembangkan karakter dan keterampilan hidup yang bermanfaat.\n\nKegiatan ini juga mempersiapkan siswa untuk menghadapi situasi darurat dan bertahan hidup di alam, serta menanamkan nilai-nilai Pancasila dalam kehidupan sehari-hari.",
                'jadwal' => 'Setiap hari Jumat, pukul 15.00-17.00 WIB',
                'pembina' => 'Bapak Ahmad Supriyadi dan Ibu Dewi Susanti',
                'is_active' => true,
            ],
            [
                'nama' => 'Tari Tradisional',
                'deskripsi' => "Ekstrakurikuler Tari Tradisional bertujuan untuk memperkenalkan dan melestarikan tarian daerah Indonesia. Siswa belajar berbagai jenis tarian dari berbagai daerah seperti tari Pendet (Bali), tari Jaipong (Jawa Barat), tari Remo (Jawa Timur), dan lainnya.\n\nMelalui kegiatan ini, siswa tidak hanya belajar teknik menari, tetapi juga memahami nilai budaya, filosofi, dan sejarah di balik setiap tarian. Kegiatan ini membantu mengembangkan kepekaan seni, kelenturan tubuh, koordinasi, dan rasa cinta terhadap kebudayaan Indonesia.",
                'jadwal' => 'Setiap hari Selasa, pukul 15.00-16.30 WIB',
                'pembina' => 'Ibu Ratna Dewi',
                'is_active' => true,
            ],
            [
                'nama' => 'Futsal',
                'deskripsi' => "Ekstrakurikuler Futsal fokus pada pengembangan keterampilan bermain sepak bola dalam ruangan. Siswa dilatih teknik dasar seperti passing, dribbling, shooting, dan strategi permainan.\n\nKegiatan ini tidak hanya mengembangkan kemampuan fisik seperti stamina, kecepatan, dan koordinasi, tetapi juga mengajarkan nilai-nilai sportivitas, kerjasama tim, dan strategi. Tim futsal sekolah secara rutin berpartisipasi dalam turnamen antar sekolah dasar di tingkat kecamatan dan kota.",
                'jadwal' => 'Setiap hari Rabu dan Sabtu, pukul 15.00-17.00 WIB',
                'pembina' => 'Bapak Doni Prakoso',
                'is_active' => true,
            ],
            [
                'nama' => 'Seni Lukis',
                'deskripsi' => "Ekstrakurikuler Seni Lukis memberikan kesempatan kepada siswa untuk mengekspresikan kreativitas mereka melalui berbagai teknik dan media lukis. Siswa belajar tentang dasar-dasar seni rupa seperti komposisi, warna, proporsi, dan perspektif.\n\nKegiatan ini mengembangkan kemampuan motorik halus, kreativitas, dan apresiasi seni. Karya-karya terbaik siswa dipamerkan dalam pameran seni tahunan sekolah dan diikutsertakan dalam berbagai lomba lukis di tingkat kecamatan dan kota.",
                'jadwal' => 'Setiap hari Kamis, pukul 15.00-16.30 WIB',
                'pembina' => 'Ibu Sari Indah',
                'is_active' => true,
            ],
        ];
        
        foreach ($ekstrakurikuler as $ekskul) {
            $ekskul['slug'] = Str::slug($ekskul['nama']);
            Ekstrakurikuler::create($ekskul);
        }
    }
} 