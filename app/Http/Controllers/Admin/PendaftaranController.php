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
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'link_pendaftaran' => 'nullable|string|max:255',
            'kontak_pendaftaran' => 'nullable|string|max:255',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'link_pendaftaran' => $request->link_pendaftaran,
                'kontak_pendaftaran' => $request->kontak_pendaftaran,
                'is_active' => $request->has('is_active')
            ];
            
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
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'link_pendaftaran' => 'nullable|string|max:255',
            'kontak_pendaftaran' => 'nullable|string|max:255',
        ]);
        
        try {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'link_pendaftaran' => $request->link_pendaftaran,
                'kontak_pendaftaran' => $request->kontak_pendaftaran,
                'is_active' => $request->has('is_active')
            ];
            
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