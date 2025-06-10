<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class ProfilSekolahController extends Controller
{
    /**
     * Display the school profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sejarah = Sejarah::where('is_active', true)->first();
        
        // Fallback if no record exists or if it's not active
        if (!$sejarah) {
            $sejarah = (object) [
                'title' => 'Sejarah',
                'content' => 'Informasi sejarah belum tersedia.',
                'visi' => 'Informasi visi belum tersedia.',
                'misi' => 'Informasi misi belum tersedia.',
                'image' => null,
                'image_date' => null
            ];
        }
        
        $profilSekolah = ProfilSekolah::where('is_active', true)->first();
        
        // Fallback if no record exists or if it's not active
        if (!$profilSekolah) {
            $profilSekolah = (object) [
                'nama_sekolah' => 'SDN Medokan Ayu II',
                'sambutan_kepala_sekolah' => 'Informasi sambutan kepala sekolah belum tersedia.',
                'nama_kepala_sekolah' => 'Kepala Sekolah',
                'foto_kepala_sekolah' => null,
                'alamat' => 'Informasi alamat belum tersedia.',
                'telepon' => 'Informasi telepon belum tersedia.',
                'email' => 'Informasi email belum tersedia.',
                'website' => 'Informasi website belum tersedia.',
                'daftar_guru' => []
            ];
        }
        
        // Data untuk heroAction.blade.php
        $tentang = (object) [
            'title' => 'Profil Sekolah',
        ];
        
        return view('public.pages.profilSekolah', [
            'sejarah' => $sejarah,
            'profilSekolah' => $profilSekolah,
            'tentang' => $tentang,
        ]);
    }
}
