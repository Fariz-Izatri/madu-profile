<?php

namespace Database\Seeders;

use App\Models\Sejarah;
use Illuminate\Database\Seeder;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete any existing sejarah records first
        Sejarah::query()->delete();
        
        // Create a single sejarah record
        Sejarah::create([
            'title' => 'Sejarah',
            'content' => "SDN Medokan Ayu II didirikan pada tahun 1980 sebagai jawaban atas kebutuhan pendidikan dasar yang berkualitas di wilayah Medokan Ayu. Awalnya sekolah ini hanya memiliki 3 ruang kelas dengan 6 guru dan sekitar 80 siswa.\n\nPada tahun 1990, sekolah mengalami perluasan pertama dengan penambahan 3 ruang kelas baru dan fasilitas perpustakaan sederhana. Seiring dengan pertumbuhan populasi di kawasan ini, pada tahun 2000 sekolah kembali direnovasi dan diperluas dengan bantuan pemerintah kota.\n\nTahun 2010 menjadi tonggak penting bagi SDN Medokan Ayu II dengan diraihnya akreditasi A dan penunjukan sebagai sekolah percontohan untuk implementasi kurikulum baru. Sejak saat itu, sekolah terus berkembang baik dari segi infrastruktur maupun kualitas pendidikan.\n\nHingga saat ini, SDN Medokan Ayu II telah menjadi salah satu sekolah dasar favorit di kawasan Surabaya Timur dengan berbagai prestasi akademik dan non-akademik yang telah diraih oleh para siswa dan guru.",
            'visi' => "Terwujudnya peserta didik yang beriman, bertaqwa, cerdas, terampil, mandiri, berprestasi, berbudaya lingkungan dan berwawasan global.",
            'misi' => "1. Menanamkan keimanan dan ketaqwaan melalui pengamalan ajaran agama\n2. Melaksanakan pembelajaran aktif, inovatif, kreatif, efektif, dan menyenangkan\n3. Menumbuhkan semangat keunggulan kepada seluruh warga sekolah\n4. Mendorong dan membantu siswa mengenali potensi dirinya untuk dikembangkan secara optimal\n5. Menciptakan lingkungan sekolah yang sehat, bersih, dan lestari\n6. Mengembangkan budaya senyum, salam, sapa, sopan dan santun",
            'image_date' => now()->subYears(5),
            'is_active' => true
        ]);
    }
}
