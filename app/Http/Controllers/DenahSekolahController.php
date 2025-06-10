<?php

namespace App\Http\Controllers;

use App\Models\DenahSekolah;
use Illuminate\Http\Request;

class DenahSekolahController extends Controller
{
    /**
     * Display the denah sekolah page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $denahSekolah = DenahSekolah::where('is_active', true)->first();
        
        // Fallback if no record exists or if it's not active
        if (!$denahSekolah) {
            $denahSekolah = (object) [
                'title' => 'Denah Sekolah',
                'description' => 'Informasi denah sekolah belum tersedia.',
                'image' => null
            ];
        }
        
        // Data untuk heroAction.blade.php
        $tentang = (object) [
            'title' => 'Denah Sekolah',
        ];
        
        return view('public.pages.denahSekolah', [
            'denahSekolah' => $denahSekolah,
            'tentang' => $tentang,
        ]);
    }
}
