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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'tanggal' => $request->tanggal,
                'penulis' => $request->penulis,
                'kategori_id' => $request->kategori_id,
                'is_populer' => $request->has('is_populer')
            ];
            
            // Upload gambar
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                try {
                    // Ensure directory exists
                    $directory = 'berita';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                        Log::info('Created directory: ' . $directory);
                    }
                    
                    $path = $request->file('gambar')->store($directory, 'public');
                    Log::info('File stored at path: ' . $path);
                    
                    if ($path) {
                        $data['gambar'] = '/storage/' . $path;
                    } else {
                        Log::error('Failed to store berita image: null path returned');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading berita image: ' . $uploadEx->getMessage());
                    // Continue without image
                }
            }
            
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'tanggal' => $request->tanggal,
                'penulis' => $request->penulis,
                'kategori_id' => $request->kategori_id,
                'is_populer' => $request->has('is_populer')
            ];
            
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                try {
                    // Hapus gambar lama jika ada
                    if ($berita->gambar && !str_starts_with($berita->gambar, 'images/')) {
                        $oldImage = str_replace('/storage/', '', $berita->gambar);
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                    
                    // Ensure directory exists
                    $directory = 'berita';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                        Log::info('Created directory: ' . $directory);
                    }
                    
                    $path = $request->file('gambar')->store($directory, 'public');
                    Log::info('File stored at path: ' . $path);
                    
                    if ($path) {
                        $data['gambar'] = '/storage/' . $path;
                    } else {
                        Log::error('Failed to store updated berita image: null path returned');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading updated berita image: ' . $uploadEx->getMessage());
                    // Continue without updating image
                }
            }
            
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
            
            // Hapus gambar jika ada
            if ($berita->gambar && !str_starts_with($berita->gambar, 'images/')) {
                $oldImage = str_replace('/storage/', '', $berita->gambar);
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
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