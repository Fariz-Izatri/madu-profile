<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class SejarahController extends Controller
{
    /**
     * Display the sejarah content for editing.
     */
    public function index()
    {
        $sejarah = Sejarah::first();
        
        // If no sejarah record exists, create one
        if (!$sejarah) {
            $sejarah = Sejarah::create([
                'title' => 'Sejarah',
                'content' => 'Konten sejarah belum diisi.',
                'visi' => 'Visi sekolah belum diisi.',
                'misi' => 'Misi sekolah belum diisi.',
                'is_active' => true
            ]);
        }
        
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    /**
     * Update the sejarah content.
     */
    public function update(Request $request, $id)
    {
        Log::info('Sejarah update request received');
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_date' => 'nullable|date',
        ]);
        
        try {
            $sejarah = Sejarah::findOrFail($id);
            
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'image_date' => $request->image_date,
                'is_active' => $request->has('is_active')
            ];
            
            // Upload new image if provided
            if ($request->hasFile('image')) {
                Log::info('Image file detected in request');
                
                if ($request->file('image')->isValid()) {
                    Log::info('Image file is valid');
                    
                    try {
                        // Delete old image if exists
                        if ($sejarah->image && !str_starts_with($sejarah->image, 'images/')) {
                            $oldImagePath = public_path(ltrim($sejarah->image, '/'));
                            if (file_exists($oldImagePath)) {
                                unlink($oldImagePath);
                                Log::info('Old image deleted: ' . $oldImagePath);
                            }
                        }
                        
                        // Simple direct file upload approach
                        $uploadedFile = $request->file('image');
                        $fileExtension = $uploadedFile->getClientOriginalExtension();
                        $fileName = 'sejarah_' . time() . '.' . $fileExtension;
                        
                        // Check if public/storage directory exists
                        $storageDir = public_path('storage');
                        $targetDir = $storageDir . '/sejarah';
                        
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
                            $data['image'] = '/storage/sejarah/' . $fileName;
                        } else {
                            Log::error('Failed to copy file to: ' . $targetPath);
                            
                            // Try an alternative approach
                            $fileContent = file_get_contents($uploadedFile->getPathname());
                            if (file_put_contents($targetPath, $fileContent)) {
                                Log::info('File saved with file_put_contents to: ' . $targetPath);
                                $data['image'] = '/storage/sejarah/' . $fileName;
                            } else {
                                Log::error('Failed to save file with file_put_contents to: ' . $targetPath);
                                Log::error('Error: ' . error_get_last()['message']);
                            }
                        }
                    } catch (Exception $uploadEx) {
                        Log::error('Error uploading updated sejarah image: ' . $uploadEx->getMessage());
                        Log::error('Exception trace: ' . $uploadEx->getTraceAsString());
                        // Continue without updating image
                    }
                } else {
                    Log::error('Image file is not valid: ' . $request->file('image')->getErrorMessage());
                }
            } else {
                Log::info('No image file in request');
            }
            
            Log::info('Updating sejarah with data: ' . json_encode($data));
            $sejarah->update($data);
            
            return redirect()->route('admin.sejarah.index')
                ->with('success', 'Sejarah berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating sejarah: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Catch-all method to redirect to index for other resource methods.
     */
    public function create()
    {
        return redirect()->route('admin.sejarah.index');
    }
    
    public function store(Request $request)
    {
        return redirect()->route('admin.sejarah.index');
    }
    
    public function show($id)
    {
        return redirect()->route('admin.sejarah.index');
    }
    
    public function edit($id)
    {
        return redirect()->route('admin.sejarah.index');
    }
    
    public function destroy($id)
    {
        return redirect()->route('admin.sejarah.index');
    }
}
