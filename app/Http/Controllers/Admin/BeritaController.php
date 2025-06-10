<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::with('kategori')->latest()->paginate(10);
        
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriBerita::all();
        
        return view('admin.berita.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date',
            'external_link' => 'nullable|url|max:255',
            'penulis' => 'nullable|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'external_link' => $request->external_link,
                'tanggal' => $request->tanggal,
                'penulis' => $request->penulis,
                'kategori_id' => $request->kategori_id,
                'is_populer' => $request->has('is_populer')
            ];
            
            Berita::create($data);
            
            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan!');
                
        } catch (Exception $e) {
            Log::error('Error creating berita: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $beritum)
    {
        $berita = $beritum; // Mengubah nama variabel untuk kejelasan
        $kategori = KategoriBerita::all();
        
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $beritum)
    {
        $berita = $beritum; // Mengubah nama variabel untuk kejelasan
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date',
            'external_link' => 'nullable|url|max:255',
            'penulis' => 'nullable|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'external_link' => $request->external_link,
                'tanggal' => $request->tanggal,
                'penulis' => $request->penulis,
                'kategori_id' => $request->kategori_id,
                'is_populer' => $request->has('is_populer')
            ];
            
            $berita->update($data);
            
            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating berita: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {
        try {
            $berita = $beritum; // Mengubah nama variabel untuk kejelasan
            $berita->delete();
            
            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus!');
                
        } catch (Exception $e) {
            Log::error('Error deleting berita: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 