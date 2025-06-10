<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete any existing records first
        Fasilitas::query()->delete();
        
        // Create sample fasilitas records
        $fasilitas = [
            [
                'nama' => 'Perpustakaan',
                'deskripsi' => 'Perpustakaan sekolah dilengkapi dengan berbagai koleksi buku, ruang baca yang nyaman, dan area multimedia untuk mendukung kegiatan literasi siswa.',
                'gambar' => '/images/fasilitas/perpustakaan.jpg',
                'is_active' => true
            ],
            [
                'nama' => 'Laboratorium Komputer',
                'deskripsi' => 'Laboratorium komputer dilengkapi dengan perangkat komputer terbaru dan koneksi internet untuk mendukung pembelajaran teknologi informasi.',
                'gambar' => '/images/fasilitas/lab-komputer.jpg',
                'is_active' => true
            ],
            [
                'nama' => 'Ruang UKS',
                'deskripsi' => 'Ruang UKS (Unit Kesehatan Sekolah) menyediakan layanan kesehatan dasar untuk siswa dan staf sekolah.',
                'gambar' => '/images/fasilitas/uks.jpg',
                'is_active' => true
            ],
            [
                'nama' => 'Lapangan Olahraga',
                'deskripsi' => 'Lapangan olahraga multifungsi yang dapat digunakan untuk berbagai aktivitas seperti upacara, olahraga, dan kegiatan ekstrakurikuler.',
                'gambar' => '/images/fasilitas/lapangan.jpg',
                'is_active' => true
            ],
            [
                'nama' => 'Mushola',
                'deskripsi' => 'Mushola sekolah yang nyaman untuk kegiatan ibadah dan pembelajaran agama Islam.',
                'gambar' => '/images/fasilitas/mushola.jpg',
                'is_active' => true
            ],
        ];
        
        // Insert the records
        Fasilitas::insert($fasilitas);
    }
} 