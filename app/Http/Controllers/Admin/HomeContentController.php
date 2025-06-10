<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeContentController extends Controller
{
    /**
     * Display a listing of the all sections.
     */
    public function index()
    {
        return view('admin.home-content.index');
    }
    
    /**
     * Display hero section content
     */
    public function heroSection()
    {
        $heroSlides = HomeContent::where('section', 'hero')
                                ->orderBy('order')
                                ->get();
        
        return view('admin.home-content.hero', compact('heroSlides'));
    }
    
    /**
     * Edit a hero slide
     */
    public function editHeroSlide($id)
    {
        $slide = HomeContent::findOrFail($id);
        
        return view('admin.home-content.hero-edit', compact('slide'));
    }
    
    /**
     * Update a hero slide
     */
    public function updateHeroSlide(Request $request, $id)
    {
        try {
            $slide = HomeContent::findOrFail($id);
            
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string',
                'button_text' => 'nullable|string|max:100',
                'button_link' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'nullable',
            ]);
            
            $data = [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ];
            
            // Handle multiple buttons if provided
            if ($request->has('additional_buttons')) {
                $buttons = [];
                foreach ($request->additional_buttons as $index => $button) {
                    if (!empty($button['text']) && !empty($button['link'])) {
                        $buttons[] = [
                            'text' => $button['text'],
                            'link' => $button['link']
                        ];
                    }
                }
                
                $data['content'] = json_encode(['buttons' => $buttons]);
            }
            
            // Upload image if provided
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                try {
                    // Delete old image if exists
                    if ($slide->image && !str_starts_with($slide->image, 'images/')) {
                        $oldImagePath = public_path(ltrim($slide->image, '/'));
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                            Log::info('Old image deleted: ' . $oldImagePath);
                        }
                    }
                    
                    // Try direct file save approach with image compression
                    $uploadedFile = $request->file('image');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'hero_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/homepage/hero';
                    
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
                        $data['image'] = '/storage/homepage/hero/' . $fileName;
                    } else {
                        Log::error('Failed to copy file to: ' . $targetPath);
                        
                        // Try an alternative approach
                        $fileContent = file_get_contents($uploadedFile->getPathname());
                        if (file_put_contents($targetPath, $fileContent)) {
                            Log::info('File saved with file_put_contents to: ' . $targetPath);
                            $data['image'] = '/storage/homepage/hero/' . $fileName;
                        } else {
                            Log::error('Failed to save file with file_put_contents to: ' . $targetPath);
                            Log::error('Error: ' . error_get_last()['message']);
                        }
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading hero image: ' . $uploadEx->getMessage());
                    Log::error('Exception trace: ' . $uploadEx->getTraceAsString());
                    // Continue without updating image
                }
            }
            
            // Debug log
            Log::info('Updating hero slide with ID: ' . $slide->id);
            Log::info('Data for update: ', $data);
            
            $slide->update($data);
            
            return redirect()->route('admin.home-content.hero')
                ->with('success', 'Slide berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating hero slide: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Display info section content
     */
    public function infoSection()
    {
        $info = HomeContent::where('section', 'info')->first();
        
        return view('admin.home-content.info', compact('info'));
    }
    
    /**
     * Update info section content
     */
    public function updateInfoSection(Request $request, $id)
    {
        try {
            $info = HomeContent::findOrFail($id);
            
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'nullable',
            ]);
            
            $data = [
                'title' => $request->title,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'content' => json_encode(['description' => $request->description])
            ];
            
            // Upload image if provided
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                try {
                    // Delete old image if exists and not a default image
                    if ($info->image && !str_starts_with($info->image, 'images/')) {
                        $oldImagePath = public_path(ltrim($info->image, '/'));
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                            Log::info('Old image deleted: ' . $oldImagePath);
                        }
                    }
                    
                    // Try direct file save approach with image compression
                    $uploadedFile = $request->file('image');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'info_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/homepage/info';
                    
                    Log::info('Storage directory: ' . $storageDir . ' exists: ' . (file_exists($storageDir) ? 'Yes' : 'No'));
                    
                    // Create directory if it doesn't exist
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0755, true);
                        Log::info('Created directory: ' . $targetDir);
                    }
                    
                    $targetPath = $targetDir . '/' . $fileName;
                    Log::info('Target path: ' . $targetPath);
                    
                    // Process and compress the image using Intervention Image v3
                    try {
                        // Create image manager instance with desired driver
                        $manager = new ImageManager(new Driver());
                        
                        // Create image instance
                        $image = $manager->read($uploadedFile->getRealPath());
                        
                        // Resize the image to max dimensions while preserving aspect ratio
                        $image->resize(800, 600, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                        
                        // Save the processed image with compression
                        $image->save($targetPath, 80);
                        
                        Log::info('Image processed and saved successfully to: ' . $targetPath);
                        $data['image'] = '/storage/homepage/info/' . $fileName;
                    } catch (\Exception $interventionEx) {
                        Log::error('Error processing image with Intervention: ' . $interventionEx->getMessage());
                        
                        // Fallback to direct copy if Intervention Image fails
                        if (copy($uploadedFile->getPathname(), $targetPath)) {
                            Log::info('File copied successfully (fallback) to: ' . $targetPath);
                            $data['image'] = '/storage/homepage/info/' . $fileName;
                        } else {
                            Log::error('Failed to copy file to: ' . $targetPath);
                            
                            // Try an alternative approach
                            $fileContent = file_get_contents($uploadedFile->getPathname());
                            if (file_put_contents($targetPath, $fileContent)) {
                                Log::info('File saved with file_put_contents to: ' . $targetPath);
                                $data['image'] = '/storage/homepage/info/' . $fileName;
                            } else {
                                Log::error('Failed to save file with file_put_contents to: ' . $targetPath);
                                Log::error('Error: ' . error_get_last()['message']);
                            }
                        }
                    }
                } catch (Exception $uploadEx) {
                    Log::error('Error uploading info image: ' . $uploadEx->getMessage());
                    Log::error('Exception trace: ' . $uploadEx->getTraceAsString());
                    // Continue without updating image
                }
            }
            
            // Debug log
            Log::info('Updating info section with ID: ' . $info->id);
            Log::info('Data for update: ', $data);
            
            $info->update($data);
            
            return redirect()->route('admin.home-content.info')
                ->with('success', 'Informasi berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating info section: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Display FAQ section content
     */
    public function faqSection()
    {
        $faq = HomeContent::where('section', 'faq')->first();
        $faqItems = $faq ? json_decode($faq->content, true)['items'] ?? [] : [];
        
        return view('admin.home-content.faq', compact('faq', 'faqItems'));
    }
    
    /**
     * Update FAQ section content
     */
    public function updateFaqSection(Request $request, $id)
    {
        try {
            $faq = HomeContent::findOrFail($id);
            
            $request->validate([
                'title' => 'required|string|max:255',
                'faq_items' => 'required|array',
                'faq_items.*.question' => 'required|string',
                'faq_items.*.answer' => 'required|string',
                'is_active' => 'nullable',
            ]);
            
            $faqItems = [];
            foreach ($request->faq_items as $index => $item) {
                if (!empty($item['question']) && !empty($item['answer'])) {
                    $faqItems[] = [
                        'question' => $item['question'],
                        'answer' => $item['answer'],
                        'is_open' => $index == 0 // Make first item open by default
                    ];
                }
            }
            
            // Debug log
            Log::info('Updating FAQ section with ID: ' . $faq->id);
            
            $faq->update([
                'title' => $request->title,
                'content' => json_encode(['items' => $faqItems]),
                'is_active' => $request->has('is_active') ? 1 : 0
            ]);
            
            return redirect()->route('admin.home-content.faq')
                ->with('success', 'FAQ berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating FAQ section: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Display prestasi chart section content
     */
    public function prestasiChartSection()
    {
        $prestasiChart = HomeContent::where('section', 'prestasi_chart')->first();
        
        if (!$prestasiChart) {
            // Create default prestasi chart data if it doesn't exist
            $prestasiChart = HomeContent::create([
                'section' => 'prestasi_chart',
                'title' => 'Prestasi Chart',
                'content' => json_encode([
                    'items' => [
                        [
                            'icon' => 'chart-icon_1.png',
                            'label' => 'Guru',
                            'count' => 39
                        ],
                        [
                            'icon' => 'chart-icon_2.png',
                            'label' => 'Murid',
                            'count' => 2600
                        ],
                        [
                            'icon' => 'chart-icon_3.png',
                            'label' => 'Extrakurikuler',
                            'count' => 23
                        ],
                        [
                            'icon' => 'chart-icon_4.png',
                            'label' => 'Medali',
                            'count' => 13
                        ]
                    ]
                ]),
                'is_active' => true,
            ]);
        }
        
        $chartItems = json_decode($prestasiChart->content, true)['items'] ?? [];
        
        return view('admin.home-content.prestasi-chart', compact('prestasiChart', 'chartItems'));
    }
    
    /**
     * Update prestasi chart section content
     */
    public function updatePrestasiChartSection(Request $request, $id)
    {
        try {
            $prestasiChart = HomeContent::findOrFail($id);
            
            $request->validate([
                'title' => 'required|string|max:255',
                'chart_items' => 'required|array',
                'chart_items.*.label' => 'required|string',
                'chart_items.*.count' => 'required|integer',
                'chart_items.*.icon' => 'nullable|string',
                'is_active' => 'nullable',
            ]);
            
            $chartItems = [];
            foreach ($request->chart_items as $item) {
                if (!empty($item['label']) && isset($item['count'])) {
                    $chartItems[] = [
                        'label' => $item['label'],
                        'count' => (int) $item['count'],
                        'icon' => $item['icon'] ?? ''
                    ];
                }
            }
            
            // Debug log
            Log::info('Updating prestasi chart section with ID: ' . $prestasiChart->id);
            
            $prestasiChart->update([
                'title' => $request->title,
                'content' => json_encode(['items' => $chartItems]),
                'is_active' => $request->has('is_active') ? 1 : 0
            ]);
            
            return redirect()->route('admin.home-content.prestasi-chart')
                ->with('success', 'Prestasi chart berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating prestasi chart section: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Display testimonial section content
     */
    public function testimonialSection()
    {
        $testimonials = HomeContent::where('section', 'testimonial')
                                ->orderBy('order')
                                ->paginate(10);
        
        return view('admin.home-content.testimonial.index', compact('testimonials'));
    }
    
    /**
     * Show form to create a new testimonial
     */
    public function createTestimonial()
    {
        return view('admin.home-content.testimonial.create');
    }
    
    /**
     * Store a new testimonial
     */
    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // This will be the testimonial quote
            'author_name' => 'required|string|max:255', // Author of the testimonial
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable',
        ]);
        
        try {
            // Get current max order
            $maxOrder = HomeContent::where('section', 'testimonial')->max('order') ?? 0;
            
            // Prepare data
            $data = [
                'section' => 'testimonial',
                'title' => $request->title, // testimonial message
                'author_name' => $request->author_name,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'order' => $maxOrder + 1
            ];
            
            // Handle image upload
            if ($request->hasFile('image')) {
                try {
                    // Try direct file save approach with image compression
                    $uploadedFile = $request->file('image');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'testimonial_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/homepage/testimonial';
                    
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
                        $data['image'] = '/storage/homepage/testimonial/' . $fileName;
                    } else {
                        Log::error('Failed to copy file to: ' . $targetPath);
                        Log::error('Error: ' . error_get_last()['message']);
                    }
                } catch (Exception $e) {
                    Log::error('Error uploading file: ' . $e->getMessage());
                    Log::error('Exception trace: ' . $e->getTraceAsString());
                    // Continue without image
                }
            }
            
            // Create the testimonial
            HomeContent::create($data);
            
            return redirect()->route('admin.home-content.testimonial')
                ->with('success', 'Testimoni berhasil ditambahkan!');
                
        } catch (Exception $e) {
            Log::error('Error creating testimonial: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Show form to edit a testimonial
     */
    public function editTestimonial($id)
    {
        $testimonial = HomeContent::findOrFail($id);
        
        // Ensure it's a testimonial section
        if ($testimonial->section !== 'testimonial') {
            return redirect()->route('admin.home-content.testimonial')
                ->with('error', 'Data testimoni tidak ditemukan!');
        }
        
        return view('admin.home-content.testimonial.edit', compact('testimonial'));
    }
    
    /**
     * Update a testimonial
     */
    public function updateTestimonial(Request $request, $id)
    {
        try {
            $testimonial = HomeContent::findOrFail($id);
            
            // Ensure it's a testimonial section
            if ($testimonial->section !== 'testimonial') {
                return redirect()->route('admin.home-content.testimonial')
                    ->with('error', 'Data testimoni tidak ditemukan!');
            }
            
            $request->validate([
                'title' => 'required|string|max:255', // Testimonial quote
                'author_name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'nullable',
            ]);
            
            $data = [
                'title' => $request->title, // testimonial message
                'author_name' => $request->author_name,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ];
            
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                try {
                    // Delete old image if exists
                    if ($testimonial->image && !str_starts_with($testimonial->image, 'images/')) {
                        $oldImagePath = public_path(ltrim($testimonial->image, '/'));
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                            Log::info('Old image deleted: ' . $oldImagePath);
                        }
                    }
                    
                    // Try direct file save approach with image compression
                    $uploadedFile = $request->file('image');
                    $fileExtension = $uploadedFile->getClientOriginalExtension();
                    $fileName = 'testimonial_' . time() . '.' . $fileExtension;
                    
                    // Check if public/storage directory exists
                    $storageDir = public_path('storage');
                    $targetDir = $storageDir . '/homepage/testimonial';
                    
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
                        $data['image'] = '/storage/homepage/testimonial/' . $fileName;
                    } else {
                        Log::error('Failed to copy file to: ' . $targetPath);
                        
                        // Try an alternative approach
                        $fileContent = file_get_contents($uploadedFile->getPathname());
                        if (file_put_contents($targetPath, $fileContent)) {
                            Log::info('File saved with file_put_contents to: ' . $targetPath);
                            $data['image'] = '/storage/homepage/testimonial/' . $fileName;
                        } else {
                            Log::error('Failed to save file with file_put_contents to: ' . $targetPath);
                            Log::error('Error: ' . error_get_last()['message']);
                        }
                    }
                } catch (Exception $e) {
                    Log::error('Error updating file: ' . $e->getMessage());
                    Log::error('Exception trace: ' . $e->getTraceAsString());
                    // Continue without updating image
                }
            }
            
            $testimonial->update($data);
            
            return redirect()->route('admin.home-content.testimonial')
                ->with('success', 'Testimoni berhasil diperbarui!');
                
        } catch (Exception $e) {
            Log::error('Error updating testimonial: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Delete a testimonial
     */
    public function destroyTestimonial($id)
    {
        try {
            $testimonial = HomeContent::findOrFail($id);
            
            // Ensure it's a testimonial section
            if ($testimonial->section !== 'testimonial') {
                return redirect()->route('admin.home-content.testimonial')
                    ->with('error', 'Data testimoni tidak ditemukan!');
            }
            
            // Delete image
            if ($testimonial->image && !str_starts_with($testimonial->image, 'images/')) {
                $oldImage = str_replace('/storage/', '', $testimonial->image);
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            // Delete record
            $testimonial->delete();
            
            return redirect()->route('admin.home-content.testimonial')
                ->with('success', 'Testimoni berhasil dihapus!');
                
        } catch (Exception $e) {
            Log::error('Error deleting testimonial: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
} 