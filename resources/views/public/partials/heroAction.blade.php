@php
    // Get a random hero slide image to use as background if available
    $heroSlide = null;
    try {
        $heroSlide = \App\Models\HomeContent::where('section', 'hero')
                                          ->where('is_active', true)
                                          ->inRandomOrder()
                                          ->first();
    } catch (\Exception $e) {
        // If there's an error, we'll just use the default styling
    }
@endphp

<div class="enhanced-page-header" @if($heroSlide) style="background-image: url('{{ Str::startsWith($heroSlide->image, 'images/') ? asset($heroSlide->image) : $heroSlide->image }}');" @endif>
    <div class="header-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-container">
                    <div class="page-decoration-circle"></div>
                    <div class="page-decoration-dots"></div>
                    <h1>{{ $tentang->title }}</h1>
                    @if(isset($tentang->subtitle))
                        <p>{{ $tentang->subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .enhanced-page-header {
        position: relative;
        padding: 160px 0 100px;
        margin-top: 0;
        background-color: #2d2d2d;
        background-image: linear-gradient(135deg, #3a3a3a 0%, #2d2d2d 100%);
        background-size: cover;
        background-position: center;
        border-radius: 0 0 30px 30px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        text-align: center;
    }
    
    .header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.8) 100%);
        z-index: 1;
    }
    
    .enhanced-page-header .container {
        position: relative;
        z-index: 2;
    }
    
    .page-title-container {
        position: relative;
        display: inline-block;
    }
    
    .page-decoration-circle {
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: rgba(203, 181, 139, 0.15);
        top: -80px;
        right: -100px;
        z-index: 1;
    }
    
    .page-decoration-dots {
        position: absolute;
        width: 80px;
        height: 80px;
        background-image: radial-gradient(circle, rgba(203, 181, 139, 0.5) 2px, transparent 3px);
        background-size: 15px 15px;
        top: -30px;
        left: -60px;
        z-index: 1;
    }
    
    .enhanced-page-header h1 {
        color: white;
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 15px;
        margin-top: 30px;
        position: relative;
        text-shadow: 1px 2px 4px rgba(0,0,0,0.5);
        padding-bottom: 15px;
        display: inline-block;
    }
    
    .enhanced-page-header h1::after {
        content: '';
        position: absolute;
        width: 60px;
        height: 3px;
        background-color: #cbb58b;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .enhanced-page-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 18px;
        max-width: 700px;
        margin: 0 auto;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    
    @media (max-width: 767px) {
        .enhanced-page-header {
            padding: 100px 0 60px;
            border-radius: 0 0 20px 20px;
        }
        
        .enhanced-page-header h1 {
            font-size: 32px;
            margin-top: 18px;
        }
        
        .enhanced-page-header p {
            font-size: 16px;
        }
        
        .page-decoration-circle,
        .page-decoration-dots {
            display: none;
        }
    }
</style>
