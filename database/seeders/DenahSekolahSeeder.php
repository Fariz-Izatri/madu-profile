<?php

namespace Database\Seeders;

use App\Models\DenahSekolah;
use Illuminate\Database\Seeder;

class DenahSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete any existing records first
        DenahSekolah::query()->delete();
        
        // Create a single denah sekolah record
        DenahSekolah::create([
            'title' => 'Denah Sekolah',
            'description' => 'Denah sekolah SDN Medokan Ayu II menunjukkan tata letak bangunan dan fasilitas yang tersedia di lingkungan sekolah. Denah ini membantu siswa, guru, dan pengunjung untuk menemukan lokasi ruang kelas, kantor administrasi, perpustakaan, laboratorium, dan fasilitas lainnya dengan mudah.',
            'image' => '/images/denah-sekolah.jpg',
            'is_active' => true
        ]);
    }
} 