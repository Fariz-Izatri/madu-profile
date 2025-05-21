<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimoni = [
            [
                'nama' => 'Karen Angela',
                'pesan' => 'Belajar dari yang terbaik, bersama yang terbaik, dari yang terbaik',
                'is_active' => true,
            ],
            [
                'nama' => 'Raymond Salazar',
                'pesan' => 'Belajar dari yang terbaik, bersama yang terbaik, dari yang terbaik',
                'is_active' => true,
            ],
        ];
        
        foreach ($testimoni as $testi) {
            Testimoni::create($testi);
        }
    }
} 