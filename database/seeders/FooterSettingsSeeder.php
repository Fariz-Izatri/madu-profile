<?php

namespace Database\Seeders;

use App\Models\FooterSettings;
use Illuminate\Database\Seeder;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete any existing records first
        FooterSettings::query()->delete();
        
        // Create footer settings
        FooterSettings::create([
            'contact_address' => 'Jl. Medokan Ayu I No.1, Medokan Ayu, Kec. Rungkut, Surabaya, Jawa Timur 60295',
            'contact_phone' => '(031) 8782337',
            'contact_email' => 'info@sdnmedokanayu2.sch.id',
            'facebook_url' => 'https://facebook.com/sdnmedokanayu2',
            'twitter_url' => 'https://twitter.com/sdnmedokanayu2',
            'instagram_url' => 'https://instagram.com/sdnmedokanayu2',
            'youtube_url' => 'https://youtube.com/sdnmedokanayu2',
            'about_text' => 'SDN Medokan Ayu II adalah sekolah dasar negeri yang berkomitmen untuk memberikan pendidikan berkualitas dan membentuk karakter siswa yang unggul.',
            'copyright_text' => '© 2023 SDN Medokan Ayu II. All rights reserved.',
            'quick_links' => json_encode([
                ['title' => 'Beranda', 'url' => '/'],
                ['title' => 'Profil', 'url' => '/profil'],
                ['title' => 'Berita', 'url' => '/berita'],
                ['title' => 'Galeri', 'url' => '/galeri'],
                ['title' => 'Kontak', 'url' => '/kontak']
            ]),
            'useful_links' => json_encode([
                ['title' => 'Pendaftaran', 'url' => '/pendaftaran'],
                ['title' => 'Ekstrakurikuler', 'url' => '/ekstrakurikuler'],
                ['title' => 'Fasilitas', 'url' => '/fasilitas'],
                ['title' => 'Denah Sekolah', 'url' => '/denah-sekolah'],
                ['title' => 'Sejarah', 'url' => '/sejarah']
            ])
        ]);
    }
} 