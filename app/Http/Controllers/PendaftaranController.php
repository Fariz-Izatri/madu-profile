<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan halaman daftar informasi pendaftaran
     */
    public function index()
    {
        $daftarPendaftaran = Pendaftaran::where('is_active', true)
                                       ->orderBy('tanggal_mulai', 'desc')
                                       ->get();
        
        $tentang = (object) [
            'title' => 'Informasi Pendaftaran',
        ];
        
        return view('public.pages.pendaftaran', compact('daftarPendaftaran', 'tentang'));
    }
} 