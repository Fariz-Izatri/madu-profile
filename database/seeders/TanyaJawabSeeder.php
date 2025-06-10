<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TanyaJawabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if FAQ/TanyaJawab content already exists
        $faq = HomeContent::where('section', 'faq')->first();
        
        if (!$faq) {
            try {
                // Create default FAQ/TanyaJawab content
                HomeContent::create([
                    'section' => 'faq',
                    'title' => 'Tanya Jawab (FAQ)',
                    'content' => json_encode([
                        'items' => [
                            [
                                'question' => 'Apa saja persyaratan untuk mendaftar di SDN Medokan Ayu II?',
                                'answer' => "Persyaratan pendaftaran siswa baru di SDN Medokan Ayu II meliputi:\n1. Usia minimal 6 tahun pada 1 Juli tahun ajaran baru\n2. Fotokopi akte kelahiran\n3. Fotokopi Kartu Keluarga\n4. Fotokopi KTP orang tua/wali\n5. Pas foto 3x4 berwarna (4 lembar)",
                                'is_open' => true
                            ],
                            [
                                'question' => 'Bagaimana prosedur pendaftaran siswa baru?',
                                'answer' => "Prosedur pendaftaran siswa baru dapat dilakukan melalui dua cara:\n1. Pendaftaran online melalui website resmi sekolah pada menu Pendaftaran\n2. Pendaftaran langsung dengan datang ke sekolah pada jam kerja (Senin-Jumat, 08.00-15.00 WIB)",
                                'is_open' => false
                            ],
                            [
                                'question' => 'Apa saja fasilitas yang tersedia di SDN Medokan Ayu II?',
                                'answer' => "SDN Medokan Ayu II memiliki berbagai fasilitas untuk menunjang kegiatan belajar mengajar, diantaranya:\n- Ruang kelas yang nyaman dan ber-AC\n- Perpustakaan dengan koleksi buku yang lengkap\n- Laboratorium komputer\n- Lapangan olahraga\n- Kantin sehat\n- UKS\n- Musholla",
                                'is_open' => false
                            ],
                            [
                                'question' => 'Apa saja kegiatan ekstrakurikuler yang ada di SDN Medokan Ayu II?',
                                'answer' => "SDN Medokan Ayu II memiliki berbagai kegiatan ekstrakurikuler yang dapat diikuti oleh siswa, diantaranya:\n- Pramuka\n- Drumband\n- Tari tradisional\n- Robotik\n- Futsal\n- Seni lukis\n- Paduan suara",
                                'is_open' => false
                            ],
                            [
                                'question' => 'Bagaimana cara menghubungi pihak sekolah untuk informasi lebih lanjut?',
                                'answer' => "Untuk informasi lebih lanjut, Anda dapat menghubungi pihak sekolah melalui:\n- Telepon: (031) 8782xxx\n- Email: info@sdn-medokanayu2.sch.id\n- Datang langsung ke sekolah pada jam kerja (Senin-Jumat, 08.00-15.00 WIB)",
                                'is_open' => false
                            ]
                        ]
                    ]),
                    'is_active' => true,
                ]);
                
                $this->command->info('FAQ/Tanya Jawab data created successfully');
            } catch (\Exception $e) {
                Log::error('Error creating FAQ/Tanya Jawab data: ' . $e->getMessage());
                $this->command->error('Error creating FAQ/Tanya Jawab data: ' . $e->getMessage());
            }
        } else {
            $this->command->info('FAQ/Tanya Jawab data already exists, skipping...');
        }
    }
}
