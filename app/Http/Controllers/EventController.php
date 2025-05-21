<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display the events page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $upcomingEvents = Event::upcoming()->take(4)->get();
        $completedEvents = Event::completed()->take(2)->get();
        
        // Data untuk heroAction.blade.php
        $tentang = (object) [
            'title' => 'Pengumuman'
        ];
        
        return view('public.pages.pengumuman', [
            'upcomingEvents' => $upcomingEvents,
            'completedEvents' => $completedEvents,
            'tentang' => $tentang,
        ]);
    }
    
    /**
     * Display all upcoming events
     *
     * @return \Illuminate\View\View
     */
    public function upcoming()
    {
        $upcomingEvents = Event::upcoming()->paginate(10);
        
        // Data untuk heroAction.blade.php
        $tentang = (object) [
            'title' => 'Pengumuman Mendatang'
        ];
        
        return view('public.pages.upcoming-events', [
            'upcomingEvents' => $upcomingEvents,
            'tentang' => $tentang,
        ]);
    }
    
    /**
     * Display all completed events
     *
     * @return \Illuminate\View\View
     */
    public function completed()
    {
        $completedEvents = Event::completed()->paginate(10);
        
        // Data untuk heroAction.blade.php
        $tentang = (object) [
            'title' => 'Pengumuman Selesai'
        ];
        
        return view('public.pages.completed-events', [
            'completedEvents' => $completedEvents,
            'tentang' => $tentang,
        ]);
    }
} 