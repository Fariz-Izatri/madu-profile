<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::latest()->paginate(10);
        
        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'tahun_ajaran' => 'required|string|max:255',
            'file_panduan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
                'tahun_ajaran' => $request->tahun_ajaran,
                'is_active' => $request->has('is_active')
            ];
            
            // Upload file panduan
            if ($request->hasFile('file_panduan') && $request->file('file_panduan')->isValid()) {
                try {
                    // Ensure directory exists
                    $directory = 'pendaftaran';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                        Log::info('Created directory: ' . $directory);
                    }
                    
                    $path = $request->file('file_panduan')->store($directory, 'public');
                    Log::info('File stored at path: ' . $path);
                    
                    if ($path) {
                        $data['file_panduan'] = '/storage/' . $path;
                    } else {
                        Log::error('Failed to store pendaftaran file: null path returned');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading pendaftaran file: ' . $uploadEx->getMessage());
                    // Continue without file
                }
            }
            
            Pendaftaran::create($data);
            
            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Informasi pendaftaran berhasil ditambahkan!');
                
        } catch (Exception $e) {
            Log::error('Error creating pendaftaran: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'tahun_ajaran' => 'required|string|max:255',
            'file_panduan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
                'tahun_ajaran' => $request->tahun_ajaran,
                'is_active' => $request->has('is_active')
            ];
            
            // Upload file panduan baru jika ada
            if ($request->hasFile('file_panduan') && $request->file('file_panduan')->isValid()) {
                try {
                    // Hapus file lama jika ada
                    if ($pendaftaran->file_panduan && !str_starts_with($pendaftaran->file_panduan, 'files/')) {
                        $oldFile = str_replace('/storage/', '', $pendaftaran->file_panduan);
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                    
                    // Ensure directory exists
                    $directory = 'pendaftaran';
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                        Log::info('Created directory: ' . $directory);
                    }
                    
                    $path = $request->file('file_panduan')->store($directory, 'public');
                    Log::info('File stored at path: ' . $path);
                    
                    if ($path) {
                        $data['file_panduan'] = '/storage/' . $path;
                    } else {
                        Log::error('Failed to store updated pendaftaran file: null path returned');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading updated pendaftaran file: ' . $uploadEx->getMessage());
                    // Continue without updating file
                }
            }
            
            $pendaftaran->update($data);
            
            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Informasi pendaftaran berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating pendaftaran: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        try {
            // Hapus file jika ada
            if ($pendaftaran->file_panduan && !str_starts_with($pendaftaran->file_panduan, 'files/')) {
                $oldFile = str_replace('/storage/', '', $pendaftaran->file_panduan);
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
            
            $pendaftaran->delete();
            
            return redirect()->route('admin.pendaftaran.index')
                ->with('success', 'Informasi pendaftaran berhasil dihapus!');
                
        } catch (Exception $e) {
            Log::error('Error deleting pendaftaran: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 