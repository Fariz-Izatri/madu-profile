<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        $testimoni = HomeContent::getTestimonials();
        
        $heroSlides = HomeContent::where('section', 'hero')
                                ->where('is_active', true)
                                ->orderBy('order')
                                ->get();
                                
        $info = HomeContent::getSection('info');
        
        $faq = HomeContent::getSection('faq');
        $faqItems = $faq ? json_decode($faq->content, true)['items'] ?? [] : [];
        
        $prestasiChart = HomeContent::getSection('prestasi_chart');
        $chartItems = $prestasiChart ? json_decode($prestasiChart->content, true)['items'] ?? [] : [];
        
        return view('public.pages.index', compact(
            'testimoni', 
            'heroSlides', 
            'info', 
            'faq', 
            'faqItems',
            'prestasiChart',
            'chartItems'
        ));
    }
} 