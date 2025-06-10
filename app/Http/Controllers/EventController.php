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
        $upcomingEvents = Event::upcoming()->get();
        $completedEvents = Event::completed()->get();
        
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
    

} 