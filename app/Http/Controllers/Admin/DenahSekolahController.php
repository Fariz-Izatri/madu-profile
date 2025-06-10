<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DenahSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class DenahSekolahController extends Controller
{
    /**
     * Display the denah sekolah content for editing.
     */
    public function index()
    {
        $denahSekolah = DenahSekolah::first();
        
        // If no record exists, create one
        if (!$denahSekolah) {
            $denahSekolah = DenahSekolah::create([
                'title' => 'Denah Sekolah',
                'description' => 'Deskripsi denah sekolah belum diisi.',
                'is_active' => true
            ]);
        }
        
        return view('admin.denah-sekolah.edit', compact('denahSekolah'));
    }

    /**
     * Update the denah sekolah content.
     */
    public function update(Request $request, $id)
    {
        try {
            $denahSekolah = DenahSekolah::findOrFail($id);
            
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_url' => 'nullable|string|url',
            ]);
            
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->has('is_active') ? true : false,
            ];
            
            // First check if URL is provided
            if ($request->filled('image_url')) {
                $data['image'] = $request->image_url;
            }
            // Then check if file is uploaded (file upload takes precedence over URL)
            elseif ($request->hasFile('image') && $request->file('image')->isValid()) {
                try {
                    // Delete old image if exists
                    if ($denahSekolah->image && !str_starts_with($denahSekolah->image, 'images/') && !filter_var($denahSekolah->image, FILTER_VALIDATE_URL)) {
                        $oldImagePath = public_path(ltrim($denahSekolah->image, '/'));
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    
                    // Upload the new image
                    $uploadedFile = $request->file('image');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'denah_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/denah';
                    
                    // Create directory if it doesn't exist
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0755, true);
                    }
                    
                    $targetPath = $targetDir . '/' . $fileName;
                    
                    // Simple file copy
                    if (copy($uploadedFile->getPathname(), $targetPath)) {
                        $data['image'] = '/storage/denah/' . $fileName;
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading denah image: ' . $uploadEx->getMessage());
                    // Continue without updating image
                }
            }
            
            $denahSekolah->update($data);
            
            return redirect()->route('admin.denah-sekolah.index')
                ->with('success', 'Denah sekolah berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating denah sekolah: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
