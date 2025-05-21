<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::orderBy('nama')->paginate(10);
        
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal' => 'nullable|string|max:255',
            'pembina' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $data = [
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'deskripsi' => $request->deskripsi,
                'jadwal' => $request->jadwal,
                'pembina' => $request->pembina,
                'is_active' => $request->has('is_active')
            ];
            
            // Upload gambar
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                try {
                    // Ensure directory exists
                    $directory = 'ekstrakurikuler';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                        Log::info('Created directory: ' . $directory);
                    }
                    
                    $path = $request->file('gambar')->store($directory, 'public');
                    Log::info('File stored at path: ' . $path);
                    
                    if ($path) {
                        $data['gambar'] = '/storage/' . $path;
                    } else {
                        Log::error('Failed to store ekstrakurikuler image: null path returned');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading ekstrakurikuler image: ' . $uploadEx->getMessage());
                    // Continue without image
                }
            }
            
            Ekstrakurikuler::create($data);
            
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
                
        } catch (Exception $e) {
            Log::error('Error creating ekstrakurikuler: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal' => 'nullable|string|max:255',
            'pembina' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $data = [
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'deskripsi' => $request->deskripsi,
                'jadwal' => $request->jadwal,
                'pembina' => $request->pembina,
                'is_active' => $request->has('is_active')
            ];
            
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                try {
                    // Hapus gambar lama jika ada
                    if ($ekstrakurikuler->gambar && !str_starts_with($ekstrakurikuler->gambar, 'images/')) {
                        $oldImage = str_replace('/storage/', '', $ekstrakurikuler->gambar);
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                    
                    // Ensure directory exists
                    $directory = 'ekstrakurikuler';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                        Log::info('Created directory: ' . $directory);
                    }
                    
                    $path = $request->file('gambar')->store($directory, 'public');
                    Log::info('File stored at path: ' . $path);
                    
                    if ($path) {
                        $data['gambar'] = '/storage/' . $path;
                    } else {
                        Log::error('Failed to store updated ekstrakurikuler image: null path returned');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading updated ekstrakurikuler image: ' . $uploadEx->getMessage());
                    // Continue without updating image
                }
            }
            
            $ekstrakurikuler->update($data);
            
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating ekstrakurikuler: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        try {
            // Hapus gambar jika ada
            if ($ekstrakurikuler->gambar && !str_starts_with($ekstrakurikuler->gambar, 'images/')) {
                $oldImage = str_replace('/storage/', '', $ekstrakurikuler->gambar);
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $ekstrakurikuler->delete();
            
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil dihapus!');
                
        } catch (Exception $e) {
            Log::error('Error deleting ekstrakurikuler: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 