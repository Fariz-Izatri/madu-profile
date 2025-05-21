<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    /**
     * Menampilkan halaman daftar ekstrakurikuler
     */
    public function index()
    {
        $daftarEkstrakurikuler = Ekstrakurikuler::where('is_active', true)
                                               ->orderBy('nama')
                                               ->get();
        
        $tentang = (object) [
            'title' => 'Ekstrakurikuler',
        ];
        
        return view('public.pages.ekstrakurikuler', compact('daftarEkstrakurikuler', 'tentang'));
    }
} 