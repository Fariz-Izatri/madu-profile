<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero section content
        HomeContent::create([
            'section' => 'hero',
            'title' => 'Selamat Datang',
            'subtitle' => 'Kenali sekolah kami lebih dekat—mulai dari cara mendaftar, fasilitas terbaik, hingga perjalanan dan cerita sekolah.',
            'button_text' => 'Info Pendaftaran',
            'button_link' => '/pendaftaran',
            'image' => 'images/slider.jpg',
            'order' => 1,
            'is_active' => true,
        ]);
        
        HomeContent::create([
            'section' => 'hero',
            'title' => 'Sekolah Nyaman, Belajar Menyenangkan',
            'subtitle' => 'Dari fasilitas modern hingga sejarah panjang, SDN Medokan Ayu 2 hadir untuk mendidik generasi unggul',
            'button_text' => 'Fasilitas',
            'button_link' => '/fasilitas',
            'image' => 'images/slider-2.jpg',
            'order' => 2,
            'is_active' => true,
        ]);
        
        HomeContent::create([
            'section' => 'hero',
            'title' => 'Tempat Tumbuh, Tempat Berprestasi',
            'subtitle' => 'Lihat Sejarah dari sekolah kami dengan mengklik tombil dibawah ini!',
            'content' => json_encode([
                'buttons' => [
                    ['text' => 'Berita', 'link' => '/berita'],
                    ['text' => 'Sejarah', 'link' => '/sejarah']
                ]
            ]),
            'image' => 'images/slider-3.jpg',
            'order' => 3,
            'is_active' => true,
        ]);
        
        // Info sekolah section
        HomeContent::create([
            'section' => 'info',
            'title' => 'Info SD Kami',
            'content' => json_encode([
                'description' => 'SDN Medokan Ayu 2 Surabaya merupakan sekolah dasar negeri yang berkomitmen memberikan pendidikan berkualitas, berkarakter, dan ramah anak. Terletak di lingkungan yang nyaman dan strategis, sekolah ini mendidik siswa dengan pendekatan yang menyenangkan serta didukung oleh tenaga pendidik profesional dan fasilitas yang memadai. SDN Medokan Ayu 2 tidak hanya fokus pada prestasi akademik, tetapi juga pengembangan akhlak, kreativitas, dan kepedulian sosial sejak dini.'
            ]),
            'image' => 'images/admission-detail/admission-detail_img.jpg',
            'order' => 1,
            'is_active' => true,
        ]);
        
        // FAQ section
        $faqs = [
            [
                'question' => 'Where can I find help for international students? Is there a section for my nationality?',
                'answer' => 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.',
                'is_open' => true
            ],
            [
                'question' => 'What are the term dates and other key University dates?',
                'answer' => 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table.',
                'is_open' => false
            ],
            [
                'question' => 'What courses do you offer?',
                'answer' => 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.',
                'is_open' => false
            ],
            [
                'question' => 'What are the entry requirements for your courses?',
                'answer' => 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.',
                'is_open' => false
            ],
            [
                'question' => 'Does the University have accommodation on campus?',
                'answer' => 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.',
                'is_open' => false
            ],
        ];
        
        HomeContent::create([
            'section' => 'faq',
            'title' => 'FAQ',
            'content' => json_encode(['items' => $faqs]),
            'order' => 1,
            'is_active' => true,
        ]);
    }
} 