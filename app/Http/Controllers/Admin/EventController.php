<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'highlight_description_1' => 'nullable|string',
            'highlight_description_2' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);
        
        // Handle images upload
        $imagesPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('events', 'public');
                $imagesPaths[] = Storage::url($path);
            }
        }
        
        $event = Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'images' => $imagesPaths,
            'highlight_description_1' => $validated['highlight_description_1'] ?? null,
            'highlight_description_2' => $validated['highlight_description_2'] ?? null,
            'is_completed' => $request->has('is_completed'),
        ]);
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'highlight_description_1' => 'nullable|string',
            'highlight_description_2' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);
        
        // Handle images upload
        $imagesPaths = $event->images ?? [];
        if ($request->hasFile('images')) {
            // Delete old images if replace_images is checked
            if ($request->has('replace_images')) {
                // Remove old image files
                if (!empty($imagesPaths)) {
                    foreach ($imagesPaths as $imagePath) {
                        // Extract path relative to storage/public
                        $path = str_replace('/storage/', '', $imagePath);
                        if (Storage::disk('public')->exists($path)) {
                            Storage::disk('public')->delete($path);
                        }
                    }
                }
                $imagesPaths = [];
            }
            
            foreach ($request->file('images') as $image) {
                $path = $image->store('events', 'public');
                $imagesPaths[] = Storage::url($path);
            }
        }
        
        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'images' => $imagesPaths,
            'highlight_description_1' => $validated['highlight_description_1'] ?? null,
            'highlight_description_2' => $validated['highlight_description_2'] ?? null,
            'is_completed' => $request->has('is_completed'),
        ]);
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        // Delete associated images
        if (!empty($event->images)) {
            foreach ($event->images as $imagePath) {
                // Extract path relative to storage/public
                $path = str_replace('/storage/', '', $imagePath);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
        
        $event->delete();
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
} 