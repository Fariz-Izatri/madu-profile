<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete any existing records first
        ProfilSekolah::query()->delete();
        
        // Sample data for daftar_guru
        $daftarGuru = json_encode([
            [
                'nama' => 'Dra. Siti Aminah, M.Pd',
                'nip' => '196501021990032001',
                'jabatan' => 'Kepala Sekolah',
                'foto' => '/images/guru/kepala-sekolah.jpg'
            ],
            [
                'nama' => 'Ahmad Fauzi, S.Pd',
                'nip' => '198203152005011003',
                'jabatan' => 'Guru Kelas VI',
                'foto' => '/images/guru/guru-1.jpg'
            ],
            [
                'nama' => 'Rina Wulandari, S.Pd',
                'nip' => '198506172007012004',
                'jabatan' => 'Guru Kelas V',
                'foto' => '/images/guru/guru-2.jpg'
            ],
            [
                'nama' => 'Budi Santoso, S.Pd',
                'nip' => '198709212009011005',
                'jabatan' => 'Guru Kelas IV',
                'foto' => '/images/guru/guru-3.jpg'
            ],
            [
                'nama' => 'Dewi Kartika, S.Pd',
                'nip' => '198810302010012006',
                'jabatan' => 'Guru Kelas III',
                'foto' => '/images/guru/guru-4.jpg'
            ],
            [
                'nama' => 'Hendra Kurniawan, S.Pd',
                'nip' => '199001152011011007',
                'jabatan' => 'Guru Kelas II',
                'foto' => '/images/guru/guru-5.jpg'
            ],
            [
                'nama' => 'Siti Fatimah, S.Pd',
                'nip' => '199105252012012008',
                'jabatan' => 'Guru Kelas I',
                'foto' => '/images/guru/guru-6.jpg'
            ],
            [
                'nama' => 'Agus Setiawan, S.Pd',
                'nip' => '198408182006041002',
                'jabatan' => 'Guru PJOK',
                'foto' => '/images/guru/guru-7.jpg'
            ],
            [
                'nama' => 'Nur Hidayah, S.Pd.I',
                'nip' => '198712142008012003',
                'jabatan' => 'Guru Pendidikan Agama Islam',
                'foto' => '/images/guru/guru-8.jpg'
            ]
        ]);
        
        // Create profil sekolah
        ProfilSekolah::create([
            'nama_sekolah' => 'SDN Medokan Ayu II',
            'sambutan_kepala_sekolah' => 'Selamat datang di website resmi SDN Medokan Ayu II. Kami berkomitmen untuk memberikan pendidikan berkualitas yang mengembangkan potensi akademik dan karakter siswa. Melalui kolaborasi antara sekolah, keluarga, dan masyarakat, kami berupaya membentuk generasi unggul yang siap menghadapi tantangan masa depan.',
            'nama_kepala_sekolah' => 'Dra. Siti Aminah, M.Pd',
            'foto_kepala_sekolah' => '/images/guru/kepala-sekolah.jpg',
            'alamat' => 'Jl. Medokan Ayu I No.1, Medokan Ayu, Kec. Rungkut, Surabaya, Jawa Timur 60295',
            'telepon' => '(031) 8782337',
            'email' => 'info@sdnmedokanayu2.sch.id',
            'website' => 'www.sdnmedokanayu2.sch.id',
            'daftar_guru' => $daftarGuru,
            'is_active' => true
        ]);
    }
} 