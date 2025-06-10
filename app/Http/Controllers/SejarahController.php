<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    /**
     * Display the history page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sejarah = Sejarah::where('is_active', true)->first();
        
        // Fallback if no record exists or if it's not active
        if (!$sejarah) {
            $sejarah = (object) [
                'title' => 'Sejarah',
                'content' => 'Informasi sejarah belum tersedia.',
                'visi' => 'Informasi visi belum tersedia.',
                'misi' => 'Informasi misi belum tersedia.',
                'image' => null,
                'image_date' => null
            ];
        }
        
        // Data untuk heroAction.blade.php
        $tentang = (object) [
            'title' => $sejarah->title,
        ];
        
        return view('public.pages.sejarah', [
            'sejarah' => $sejarah,
            'tentang' => $tentang,
        ]);
    }
}
