<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('id')->paginate(10);
        
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $data = [
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->has('is_active') ? true : false,
            ];
            
            // Upload gambar
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                try {
                    // Simple direct file upload approach
                    $uploadedFile = $request->file('gambar');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'fasilitas_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/fasilitas';
                    
                    Log::info('Storage directory: ' . $storageDir . ' exists: ' . (file_exists($storageDir) ? 'Yes' : 'No'));
                    
                    // Create directory if it doesn't exist
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0755, true);
                        Log::info('Created directory: ' . $targetDir);
                    }
                    
                    $targetPath = $targetDir . '/' . $fileName;
                    Log::info('Target path: ' . $targetPath);
                    
                    // Simple file copy
                    if (copy($uploadedFile->getPathname(), $targetPath)) {
                        Log::info('File copied successfully to: ' . $targetPath);
                        $data['gambar'] = '/storage/fasilitas/' . $fileName;
                    } else {
                        Log::error('Failed to copy file to: ' . $targetPath);
                        
                        // Try an alternative approach
                        $fileContent = file_get_contents($uploadedFile->getPathname());
                        if (file_put_contents($targetPath, $fileContent)) {
                            Log::info('File saved with file_put_contents to: ' . $targetPath);
                            $data['gambar'] = '/storage/fasilitas/' . $fileName;
                        } else {
                            Log::error('Failed to save file with file_put_contents to: ' . $targetPath);
                            Log::error('Error: ' . error_get_last()['message']);
                        }
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading fasilitas image: ' . $uploadEx->getMessage());
                    Log::error('Exception trace: ' . $uploadEx->getTraceAsString());
                    // Continue without image
                }
            }
            
            Fasilitas::create($data);
            
            return redirect()->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil ditambahkan!');
                
        } catch (Exception $e) {
            Log::error('Error creating fasilitas: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilita)
    {
        $fasilitas = $fasilita; // Mengubah nama variabel untuk kejelasan
        
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilita)
    {
        $fasilitas = $fasilita; // Mengubah nama variabel untuk kejelasan
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $data = [
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->has('is_active') ? true : false,
            ];
            
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                try {
                    // Hapus gambar lama jika ada
                    if ($fasilitas->gambar && !str_starts_with($fasilitas->gambar, 'images/')) {
                        $oldImagePath = public_path(ltrim($fasilitas->gambar, '/'));
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                            Log::info('Old image deleted: ' . $oldImagePath);
                        }
                    }
                    
                    // Simple direct file upload approach
                    $uploadedFile = $request->file('gambar');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'fasilitas_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/fasilitas';
                    
                    Log::info('Storage directory: ' . $storageDir . ' exists: ' . (file_exists($storageDir) ? 'Yes' : 'No'));
                    
                    // Create directory if it doesn't exist
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0755, true);
                        Log::info('Created directory: ' . $targetDir);
                    }
                    
                    $targetPath = $targetDir . '/' . $fileName;
                    Log::info('Target path: ' . $targetPath);
                    
                    // Simple file copy
                    if (copy($uploadedFile->getPathname(), $targetPath)) {
                        Log::info('File copied successfully to: ' . $targetPath);
                        $data['gambar'] = '/storage/fasilitas/' . $fileName;
                    } else {
                        Log::error('Failed to copy file to: ' . $targetPath);
                        
                        // Try an alternative approach
                        $fileContent = file_get_contents($uploadedFile->getPathname());
                        if (file_put_contents($targetPath, $fileContent)) {
                            Log::info('File saved with file_put_contents to: ' . $targetPath);
                            $data['gambar'] = '/storage/fasilitas/' . $fileName;
                        } else {
                            Log::error('Failed to save file with file_put_contents to: ' . $targetPath);
                            Log::error('Error: ' . error_get_last()['message']);
                        }
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading updated fasilitas image: ' . $uploadEx->getMessage());
                    Log::error('Exception trace: ' . $uploadEx->getTraceAsString());
                    // Continue without updating image
                }
            }
            
            $fasilitas->update($data);
            
            return redirect()->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating fasilitas: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilita)
    {
        try {
            $fasilitas = $fasilita; // Mengubah nama variabel untuk kejelasan
            
            // Hapus gambar jika ada
            if ($fasilitas->gambar && !str_starts_with($fasilitas->gambar, 'images/')) {
                $oldImagePath = public_path(ltrim($fasilitas->gambar, '/'));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $fasilitas->delete();
            
            return redirect()->route('admin.fasilitas.index')
                ->with('success', 'Fasilitas berhasil dihapus!');
                
        } catch (Exception $e) {
            Log::error('Error deleting fasilitas: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
