<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBerita::withCount('berita')
                                 ->orderBy('nama')
                                 ->get();
        
        return view('admin.kategori-berita.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama',
            'deskripsi' => 'nullable|string',
        ]);
        
        try {
            KategoriBerita::create([
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'deskripsi' => $request->deskripsi,
            ]);
            
            return redirect()->route('admin.kategori-berita.index')
                    ->with('success', 'Kategori berhasil ditambahkan!');
                    
        } catch (Exception $e) {
            Log::error('Error adding category: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBerita $kategoriBeritum)
    {
        $kategori = $kategoriBeritum; // Mengubah nama variabel untuk kejelasan
        
        return view('admin.kategori-berita.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBerita $kategoriBeritum)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama,' . $kategoriBeritum->id,
            'deskripsi' => 'nullable|string',
        ]);
        
        try {
            $kategoriBeritum->update([
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'deskripsi' => $request->deskripsi,
            ]);
            
            return redirect()->route('admin.kategori-berita.index')
                    ->with('success', 'Kategori berhasil diperbarui!');
                    
        } catch (Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBerita $kategoriBeritum)
    {
        try {
            // Check if category has related news
            if ($kategoriBeritum->berita()->exists()) {
                return redirect()->back()
                        ->withErrors(['error' => 'Kategori tidak dapat dihapus karena masih memiliki berita terkait.']);
            }
            
            $kategoriBeritum->delete();
            
            return redirect()->route('admin.kategori-berita.index')
                    ->with('success', 'Kategori berhasil dihapus!');
                    
        } catch (Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            
            return redirect()->back()
                    ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 