<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman daftar berita
     */
    public function index()
    {
        $daftarBerita = Berita::latest('tanggal')->paginate(6);
        
        $tentang = (object) [
            'title' => 'Berita',
        ];
        
        return view('public.pages.berita', compact('daftarBerita', 'tentang'));
    }
    
    /**
     * Menampilkan halaman detail berita
     */
    public function detail($id)
    {
        $berita = Berita::findOrFail($id);
        
        $tentang = (object) [
            'title' => $berita->judul,
        ];
        
        return view('public.pages.detail-berita', compact('berita', 'tentang'));
    }
    
    /**
     * Menampilkan berita berdasarkan kategori
     */
    public function kategori($slug)
    {
        $kategori = KategoriBerita::where('slug', $slug)->firstOrFail();
        $daftarBerita = Berita::kategori($slug)->latest('tanggal')->paginate(6);
        
        $tentang = (object) [
            'title' => 'Kategori: ' . $kategori->nama,
        ];
        
        return view('public.pages.berita', compact('daftarBerita', 'tentang'));
    }
    
    /**
     * Mencari berita berdasarkan kata kunci
     */
    public function cari(Request $request)
    {
        $kataKunci = $request->input('kata_kunci');
        $daftarBerita = Berita::cari($kataKunci)->latest('tanggal')->paginate(6);
        
        $tentang = (object) [
            'title' => 'Hasil Pencarian: ' . $kataKunci,
        ];
        
        return view('public.pages.berita', compact('daftarBerita', 'tentang', 'kataKunci'));
    }
} 