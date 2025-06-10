<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Menampilkan halaman daftar fasilitas
     */
    public function index()
    {
        $daftarFasilitas = Fasilitas::aktif()->urutan()->get();
        
        $tentang = (object) [
            'title' => 'Fasilitas',
        ];
        
        return view('public.pages.fasilitas', compact('daftarFasilitas', 'tentang'));
    }
    
    /**
     * Menampilkan halaman detail fasilitas
     */
    public function detail($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        
        $tentang = (object) [
            'title' => $fasilitas->nama,
        ];
        
        return view('public.pages.detail-fasilitas', compact('fasilitas', 'tentang'));
    }
}
