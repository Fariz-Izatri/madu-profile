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
            'pembina' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes',
        ]);
        
        try {
            $data = [
                'nama' => $request->nama,
                'pembina' => $request->pembina,
                'jadwal' => $request->jadwal,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->has('is_active'),
                'slug' => Str::slug($request->nama),
            ];
            
            // Upload gambar jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                // Upload dan simpan gambar
                $uploadedFile = $request->file('gambar');
                $fileName = 'ekstrakurikuler_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                
                $targetDir = public_path('storage/ekstrakurikuler');
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                $targetPath = $targetDir . '/' . $fileName;
                
                if (copy($uploadedFile->getPathname(), $targetPath)) {
                    $data['gambar'] = '/storage/ekstrakurikuler/' . $fileName;
                } else {
                    // Fallback jika copy gagal
                    $fileContent = file_get_contents($uploadedFile->getPathname());
                    if (file_put_contents($targetPath, $fileContent)) {
                        $data['gambar'] = '/storage/ekstrakurikuler/' . $fileName;
                    }
                }
            }
            
            $ekstrakurikuler = Ekstrakurikuler::create($data);
            
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
                
        } catch (Exception $e) {
            Log::error('Error creating ekstrakurikuler: ' . $e->getMessage());
            
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pembina' => 'nullable|string|max:255',
            'jadwal' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes',
        ]);
        
        try {
            $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
            
            $data = [
                'nama' => $request->nama,
                'pembina' => $request->pembina,
                'jadwal' => $request->jadwal,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->has('is_active'),
                'slug' => Str::slug($request->nama),
            ];
            
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                // Hapus gambar lama jika ada
                if ($ekstrakurikuler->gambar && !str_starts_with($ekstrakurikuler->gambar, 'images/')) {
                    $oldImagePath = public_path(ltrim($ekstrakurikuler->gambar, '/'));
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                
                // Upload dan simpan gambar baru
                $uploadedFile = $request->file('gambar');
                $fileName = 'ekstrakurikuler_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                
                $targetDir = public_path('storage/ekstrakurikuler');
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                $targetPath = $targetDir . '/' . $fileName;
                
                if (copy($uploadedFile->getPathname(), $targetPath)) {
                    $data['gambar'] = '/storage/ekstrakurikuler/' . $fileName;
                } else {
                    // Fallback jika copy gagal
                    $fileContent = file_get_contents($uploadedFile->getPathname());
                    if (file_put_contents($targetPath, $fileContent)) {
                        $data['gambar'] = '/storage/ekstrakurikuler/' . $fileName;
                    }
                }
            }
            
            $ekstrakurikuler->update($data);
            
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
                
        } catch (Exception $e) {
            Log::error('Error updating ekstrakurikuler: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($ekstrakurikuler->gambar && !str_starts_with($ekstrakurikuler->gambar, 'images/')) {
                $imagePath = public_path(ltrim($ekstrakurikuler->gambar, '/'));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $ekstrakurikuler->delete();
            
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil dihapus.');
                
        } catch (Exception $e) {
            Log::error('Error deleting ekstrakurikuler: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 