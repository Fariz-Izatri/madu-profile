<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimoni = Testimoni::orderBy('nama')->paginate(10);
        
        return view('admin.testimoni.index', compact('testimoni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimoni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pesan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Prepare basic data
            $data = [
                'nama' => $request->nama,
                'pesan' => $request->pesan,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'gambar' => null // Default to null
            ];
            
            Log::info('Creating testimoni with data: ', $data);
            
            // Handle image upload separately
            if ($request->hasFile('gambar')) {
                try {
                    Log::info('Handling file upload for testimoni');
                    
                    if ($request->file('gambar')->isValid()) {
                        $path = $request->file('gambar')->store('testimoni', 'public');
                        Log::info('File stored at path: ' . $path);
                        
                        if ($path) {
                            $data['gambar'] = '/storage/' . $path;
                        }
                    } else {
                        Log::warning('Invalid file upload attempt');
                    }
                } catch (Exception $uploadEx) {
                    Log::error('File upload error: ' . $uploadEx->getMessage());
                    // Continue without image rather than failing
                }
            }
            
            // Create record
            $testimoni = new Testimoni();
            $testimoni->nama = $data['nama'];
            $testimoni->pesan = $data['pesan'];
            $testimoni->is_active = $data['is_active'];
            if (!empty($data['gambar'])) {
                $testimoni->gambar = $data['gambar'];
            }
            
            $testimoni->save();
            
            DB::commit();
            Log::info('Testimoni created successfully with ID: ' . $testimoni->id);
            
            return redirect()->route('admin.testimoni.index')
                ->with('success', 'Testimoni berhasil ditambahkan!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating testimony: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.edit', compact('testimoni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pesan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $data = [
                'nama' => $request->nama,
                'pesan' => $request->pesan,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ];
            
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                // Hapus gambar lama jika ada
                if ($testimoni->gambar) {
                    $oldImage = str_replace('/storage/', '', $testimoni->gambar);
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
                
                $path = $request->file('gambar')->store('testimoni', 'public');
                if ($path) {
                    $data['gambar'] = '/storage/' . $path;
                }
            }
            
            // Debug log
            Log::info('Updating testimoni with ID: ' . $testimoni->id);
            Log::info('Data for update: ', $data);
            
            $testimoni->update($data);
            
            return redirect()->route('admin.testimoni.index')
                ->with('success', 'Testimoni berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating testimony: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        try {
            // Hapus gambar jika ada
            if ($testimoni->gambar) {
                $oldImage = str_replace('/storage/', '', $testimoni->gambar);
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $testimoni->delete();
            
            return redirect()->route('admin.testimoni.index')
                ->with('success', 'Testimoni berhasil dihapus!');
                
        } catch (Exception $e) {
            Log::error('Error deleting testimony: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 