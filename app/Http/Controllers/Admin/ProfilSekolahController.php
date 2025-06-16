<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ProfilSekolahController extends Controller
{
    /**
     * Display the form for editing the profile
     */
    public function index()
    {
        $profilSekolah = ProfilSekolah::first();
        
        if (!$profilSekolah) {
            $profilSekolah = ProfilSekolah::create([
                'nama_sekolah' => 'SDN Medokan Ayu II',
                'sambutan_kepala_sekolah' => 'Selamat datang di website resmi SDN Medokan Ayu II.',
                'nama_kepala_sekolah' => 'Kepala Sekolah',
                'is_active' => true,
            ]);
        }
        
        return view('admin.profil-sekolah.edit', compact('profilSekolah'));
    }
    
    /**
     * Update the specified profile
     */
    public function update(Request $request, ProfilSekolah $profilSekolah)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'sambutan_kepala_sekolah' => 'required|string',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'foto_kepala_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kepala_sekolah_url' => 'nullable|string|url',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
        ]);
        
        try {
            $data = [
                'nama_sekolah' => $request->nama_sekolah,
                'sambutan_kepala_sekolah' => $request->sambutan_kepala_sekolah,
                'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'website' => $request->website,
                'is_active' => $request->has('is_active') ? true : false,
            ];
            
            // First check if URL is provided
            if ($request->filled('foto_kepala_sekolah_url')) {
                $data['foto_kepala_sekolah'] = $request->foto_kepala_sekolah_url;
            }
            // Then check if file is uploaded (file upload takes precedence over URL)
            elseif ($request->hasFile('foto_kepala_sekolah') && $request->file('foto_kepala_sekolah')->isValid()) {
                try {
                    // Delete old image if exists
                    if ($profilSekolah->foto_kepala_sekolah && !str_starts_with($profilSekolah->foto_kepala_sekolah, 'images/') && !filter_var($profilSekolah->foto_kepala_sekolah, FILTER_VALIDATE_URL)) {
                        $oldImagePath = public_path(ltrim($profilSekolah->foto_kepala_sekolah, '/'));
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    
                    // Simple direct file upload approach
                    $uploadedFile = $request->file('foto_kepala_sekolah');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'kepsek_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/profil';
                    
                    // Create directory if it doesn't exist
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0755, true);
                    }
                    
                    $targetPath = $targetDir . '/' . $fileName;
                    
                    // Simple file copy
                    if (copy($uploadedFile->getPathname(), $targetPath)) {
                        $data['foto_kepala_sekolah'] = '/storage/profil/' . $fileName;
                    } else {
                        // Try an alternative approach
                        $fileContent = file_get_contents($uploadedFile->getPathname());
                        if (file_put_contents($targetPath, $fileContent)) {
                            $data['foto_kepala_sekolah'] = '/storage/profil/' . $fileName;
                        }
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading kepala sekolah image: ' . $uploadEx->getMessage());
                    // Continue without updating image
                }
            }
            
            $profilSekolah->update($data);
            
            return redirect()->route('admin.profil-sekolah.index')
                ->with('success', 'Profil sekolah berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating profil sekolah: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Manage teacher data
     */
    public function teachers(ProfilSekolah $profilSekolah)
    {
        return view('admin.profil-sekolah.teachers', compact('profilSekolah'));
    }
    
    /**
     * Update teacher data
     */
    public function updateTeachers(Request $request, ProfilSekolah $profilSekolah)
    {
        $request->validate([
            'guru' => 'nullable|array',
            'guru.*.nama' => 'required|string|max:255',
            'guru.*.jabatan' => 'nullable|string|max:255',
            'guru.*.foto' => 'nullable|string',
        ]);
        
        try {
            $guruData = $request->guru ?? [];
            
            // Process file uploads if any
            foreach ($guruData as $index => $guru) {
                if (isset($request->file('guru_foto')[$index]) && $request->file('guru_foto')[$index]) {
                    $file = $request->file('guru_foto')[$index];
                    
                    if ($file->isValid()) {
                        $fileName = 'guru_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                        $targetDir = public_path('storage/profil/guru');
                        
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0755, true);
                        }
                        
                        $file->move($targetDir, $fileName);
                        
                        // Only override URL if there's no URL or the upload is successful
                        if (empty($guruData[$index]['foto']) || $file) {
                            $guruData[$index]['foto'] = '/storage/profil/guru/' . $fileName;
                        }
                    }
                }
            }
            
            $profilSekolah->update([
                'daftar_guru' => $guruData,
            ]);
            
            return redirect()->route('admin.profil-sekolah.teachers', $profilSekolah->id)
                ->with('success', 'Data guru berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating teacher data: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Manage staff data
     */
    public function staff(ProfilSekolah $profilSekolah)
    {
        return view('admin.profil-sekolah.staff', compact('profilSekolah'));
    }
    
    /**
     * Update staff data
     */
    public function updateStaff(Request $request, ProfilSekolah $profilSekolah)
    {
        $request->validate([
            'staff' => 'nullable|array',
            'staff.*.nama' => 'required|string|max:255',
            'staff.*.jabatan' => 'nullable|string|max:255',
            'staff.*.foto' => 'nullable|string',
        ]);
        
        try {
            $staffData = $request->staff ?? [];
            
            // Process file uploads if any
            foreach ($staffData as $index => $staff) {
                if (isset($request->file('staff_foto')[$index]) && $request->file('staff_foto')[$index]) {
                    $file = $request->file('staff_foto')[$index];
                    
                    if ($file->isValid()) {
                        $fileName = 'staff_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                        $targetDir = public_path('storage/profil/staff');
                        
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0755, true);
                        }
                        
                        $file->move($targetDir, $fileName);
                        
                        // Only override URL if there's no URL or the upload is successful
                        if (empty($staffData[$index]['foto']) || $file) {
                            $staffData[$index]['foto'] = '/storage/profil/staff/' . $fileName;
                        }
                    }
                }
            }
            
            $profilSekolah->update([
                'daftar_staff' => $staffData,
            ]);
            
            return redirect()->route('admin.profil-sekolah.staff', $profilSekolah->id)
                ->with('success', 'Data staff berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating staff data: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
