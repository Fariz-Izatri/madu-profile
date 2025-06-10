<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(10);
        
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
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean|nullable',
            'is_active' => 'boolean|nullable',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'location' => $validated['location'] ?? null,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active', true),
        ];
        
        // Upload gambar
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadedFile = $request->file('image');
            $fileName = 'event_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs('events', $fileName, 'public');
            $data['image'] = '/storage/' . $path;
        }
        
        Event::create($data);
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
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
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean|nullable',
            'is_active' => 'boolean|nullable',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'location' => $validated['location'] ?? null,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active', true),
        ];
        
        // Upload gambar baru jika ada
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Hapus gambar lama jika ada
            if ($event->image && !str_starts_with($event->image, 'images/')) {
                $oldImage = str_replace('/storage/', '', $event->image);
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $uploadedFile = $request->file('image');
            $fileName = 'event_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs('events', $fileName, 'public');
            $data['image'] = '/storage/' . $path;
        }
        
        $event->update($data);
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        // Hapus gambar jika ada
        if ($event->image && !str_starts_with($event->image, 'images/')) {
            $oldImage = str_replace('/storage/', '', $event->image);
            if (Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }
        
        $event->delete();
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
} 