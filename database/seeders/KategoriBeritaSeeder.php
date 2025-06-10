<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete any existing records first
        KategoriBerita::query()->delete();
        
        // Create sample kategori berita
        $kategori = [
            [
                'nama' => 'Kegiatan Sekolah',
                'slug' => 'kegiatan-sekolah'
            ],
            [
                'nama' => 'Prestasi',
                'slug' => 'prestasi'
            ],
            [
                'nama' => 'Pengumuman',
                'slug' => 'pengumuman'
            ],
            [
                'nama' => 'Artikel Pendidikan',
                'slug' => 'artikel-pendidikan'
            ],
            [
                'nama' => 'Berita Umum',
                'slug' => 'berita-umum'
            ]
        ];
        
        // Insert the records
        KategoriBerita::insert($kategori);
    }
} 