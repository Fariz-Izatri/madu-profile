@php
    // Get only the first active slide for mobile view
    $firstSlide = $heroSlides->first();
@endphp

<section>
  <div class="slider_img layout_two loading">
      <!-- Desktop Carousel - Enhanced with crossfade transition -->
      <div id="homeCarousel" class="carousel slide carousel-fade d-none d-md-block" data-ride="carousel" data-interval="7000">
          <ol class="carousel-indicators">
              @foreach($heroSlides as $index => $slide)
                  <li data-target="#homeCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
              @endforeach
          </ol>
          <div class="carousel-inner" role="listbox">
              @foreach($heroSlides as $index => $slide)
                  <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                      <!-- Desktop decoration elements -->
                      <div class="hero-decoration-circle"></div>
                      <div class="hero-decoration-dots"></div>
                      
                      <!-- Image with overlay -->
                      <div class="hero-image-container">
                          @if(Str::startsWith($slide->image, 'images/'))
                              <img class="d-block carousel-image" src="{{ asset($slide->image) }}" alt="Slide {{ $index + 1 }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" decoding="async">
                          @else
                              <img class="d-block carousel-image" src="{{ $slide->image }}" alt="Slide {{ $index + 1 }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" decoding="async">
                          @endif
                      </div>
                      
                      <div class="carousel-caption d-md-block">
                          <div class="slider_title">
                              <!-- School label badge for desktop -->
                              <div class="hero-badge">SEKOLAH DASAR NEGERI</div>
                              
                              <h1>{{ $slide->title }}</h1>
                              <h4>{!! nl2br(e($slide->subtitle)) !!}</h4>
                              <div class="slider-btn">
                                  @if($slide->button_text && $slide->button_link)
                                      <a href="{{ url($slide->button_link) }}" class="btn btn-hero">
                                          <i class="icon-arrow-right-circle"></i> {{ $slide->button_text }}
                                      </a>
                                  @endif
                                  @if($slide->content && isset(json_decode($slide->content, true)['buttons']))
                                      @foreach(json_decode($slide->content, true)['buttons'] as $button)
                                          <a href="{{ url($button['link']) }}" class="btn btn-hero">
                                              <i class="icon-arrow-right-circle"></i> {{ $button['text'] }}
                                          </a>
                                      @endforeach
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
          <!-- Modern arrow controls -->
          <a class="carousel-control-prev modern-control" href="#homeCarousel" role="button" data-slide="prev">
              <span class="modern-arrow-left">
                  <i class="icon-arrow-left"></i>
              </span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next modern-control" href="#homeCarousel" role="button" data-slide="next">
              <span class="modern-arrow-right">
                  <i class="icon-arrow-right"></i>
              </span>
              <span class="sr-only">Next</span>
          </a>
      </div>
      
      <!-- Mobile Hero - Enhanced Single Image with modern UI -->
      @if($firstSlide)
      <div class="mobile-hero d-md-none">
          <div class="hero-item">
              <!-- Mobile header decoration elements -->
              <div class="mobile-hero-decoration-circle"></div>
              <div class="mobile-hero-decoration-dots"></div>
              
              <!-- Main hero image -->
              @if(Str::startsWith($firstSlide->image, 'images/'))
                  <img class="d-block w-100" src="{{ asset($firstSlide->image) }}" alt="Mobile Hero" loading="eager" decoding="async">
              @else
                  <img class="d-block w-100" src="{{ $firstSlide->image }}" alt="Mobile Hero" loading="eager" decoding="async">
              @endif
              
              <div class="carousel-caption">
                  <div class="slider_title">
                      <!-- School label badge -->
                      <div class="mobile-hero-badge">SEKOLAH DASAR NEGERI</div>
                      
                      <h1>{{ $firstSlide->title }}</h1>
                      <h4>{!! nl2br(e($firstSlide->subtitle)) !!}</h4>
                      <div class="slider-btn">
                          @if($firstSlide->button_text && $firstSlide->button_link)
                              <a href="{{ url($firstSlide->button_link) }}" class="btn btn-hero">
                                  <i class="icon-arrow-right-circle"></i> {{ $firstSlide->button_text }}
                              </a>
                          @endif
                          @if($firstSlide->content && isset(json_decode($firstSlide->content, true)['buttons']))
                              @foreach(json_decode($firstSlide->content, true)['buttons'] as $button)
                                  <a href="{{ url($button['link']) }}" class="btn btn-hero">
                                      <i class="icon-arrow-right-circle"></i> {{ $button['text'] }}
                                  </a>
                              @endforeach
                          @endif
                      </div>
                      
                      <!-- Scroll hint -->
                      <div class="mobile-hero-scroll-hint">
                          <span>Geser ke bawah</span>
                          <i class="icon-arrow-down"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @endif
      
      <!-- Preload images to prevent flash during transitions -->
      <div style="display: none;" class="preload-container">
          @foreach($heroSlides as $index => $slide)
              @if(Str::startsWith($slide->image, 'images/'))
                  <img src="{{ asset($slide->image) }}" alt="Preload {{ $index + 1 }}" data-slide-index="{{ $index }}" class="preload-image">
              @else
                  <img src="{{ $slide->image }}" alt="Preload {{ $index + 1 }}" data-slide-index="{{ $index }}" class="preload-image">
              @endif
          @endforeach
      </div>
  </div>
</section>

@push('styles')
<style>
    /* Enhanced hero styling for both mobile and desktop */
    
    /* Loading state */
    .slider_img.loading {
        opacity: 0.5;
    }
    
    .slider_img.loading::after {
        content: 'Loading images...';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 18px;
        z-index: 1000;
    }
    
    /* Fix black screen issue during carousel transitions - with contained scope */
    #homeCarousel {
        background: transparent !important;
        /* Prevent layout shifts during transitions - but only for carousel */
        contain: layout style paint !important;
        will-change: auto !important;
        /* Isolate carousel positioning */
        position: relative !important;
        z-index: 1 !important;
    }
    
    .carousel-inner {
        background: transparent !important;
        position: relative !important;
        /* Prevent content jumping during transitions - scoped to carousel */
        contain: layout style paint !important;
    }
    
    /* Override Bootstrap's default slide transition with crossfade */
    .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
        transform: none !important;
        background: transparent !important;
        /* Prevent layout shifts - but only within carousel */
        contain: style paint !important; /* Removed layout containment */
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }
    
    .carousel-fade .carousel-item.active,
    .carousel-fade .carousel-item-next.carousel-item-left,
    .carousel-fade .carousel-item-prev.carousel-item-right {
        opacity: 1;
        transform: none !important;
        position: relative !important;
    }
    
    .carousel-fade .carousel-item-left.active,
    .carousel-fade .carousel-item-right.active {
        opacity: 0;
        transform: none !important;
        position: absolute !important;
    }
    
    .carousel-fade .carousel-item-next,
    .carousel-fade .carousel-item-prev,
    .carousel-fade .carousel-item.active.carousel-item-left,
    .carousel-fade .carousel-item.active.carousel-item-prev {
        transform: none !important;
    }
    
    /* Ensure images cover the entire area smoothly without affecting layout */
    .carousel-image {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        background: transparent !important;
        /* Prevent image from affecting page layout during transitions */
        contain: style paint !important; /* Removed layout containment */
    }
    
    /* Remove any background that might show during transitions */
    .carousel-item {
        background: transparent !important;
        position: relative !important;
    }
    
    /* Prevent the entire carousel from affecting document flow - but keep it scoped */
    .slider_img {
        /* Set fixed height to prevent layout shifts - only for carousel section */
        min-height: 400px !important;
        contain: style !important; /* Removed layout containment to prevent header issues */
        overflow: hidden !important;
        /* Isolate carousel from affecting global layout */
        position: relative !important;
        z-index: 1 !important;
    }
    
    /* Preload container improvements */
    .preload-container {
        position: absolute !important;
        top: -9999px !important;
        left: -9999px !important;
        visibility: hidden !important;
        pointer-events: none !important;
    }
    
    .preload-image {
        width: 1px !important;
        height: 1px !important;
        opacity: 0 !important;
    }
    
    /* Hero image overlay for better text readability */
    .carousel-item::after,
    .mobile-hero .hero-item::after {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.6) 100%) !important;
        z-index: 1 !important;
    }
    
    /* Modern arrow controls */
    .modern-control {
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 20 !important;
    }
    
    .slider_img:hover .modern-control {
        opacity: 1;
    }
    
    .modern-arrow-left,
    .modern-arrow-right {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .modern-arrow-left:hover,
    .modern-arrow-right:hover {
        background-color: rgba(203, 181, 139, 0.8);
        transform: scale(1.1);
    }
    
    .modern-arrow-left i,
    .modern-arrow-right i {
        font-size: 20px;
        color: white;
    }        /* Desktop hero styles with proper layering */
        @media (min-width: 768px) {
            .carousel-item {
                position: relative;
                overflow: hidden;
                background: transparent !important;
                /* Prevent layout shifts during image scale animation - but keep scoped */
                contain: style paint !important; /* Removed layout containment */
            }
            
            .carousel-item img {
                filter: brightness(0.9);
                /* Remove transform animation that causes layout shifts */
                transition: filter 0.3s ease !important;
                background: transparent !important;
                /* Prevent image scaling from affecting scrollbar */
                will-change: filter !important;
            }
            
            /* Remove the scale animation that causes scrollbar issues */
            .carousel-item.active img {
                /* transform: scale(1.05); */ /* Disabled to prevent layout shifts */
                filter: brightness(0.85);
            }
        
        .hero-decoration-circle {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: rgba(203, 181, 139, 0.15);
            top: -80px;
            right: -80px;
            z-index: 2;
        }
        
        .hero-decoration-dots {
            position: absolute;
            width: 120px;
            height: 120px;
            background-image: radial-gradient(circle, #cbb58b 2px, transparent 3px);
            background-size: 20px 20px;
            top: 40px;
            left: 40px;
            z-index: 2;
        }
        
        .carousel-caption {
            z-index: 5;
            text-align: left;
            left: 10%;
            right: 10%;
        }
        
        .slider_title h1 {
            font-size: 48px;
            text-align: left;
            margin-bottom: 20px;
            padding-left: 20px;
            border-left: 5px solid #cbb58b;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }
        
        .slider_title h4 {
            text-align: left;
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 30px;
            font-weight: 300;
            max-width: 70%;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        .slider-btn {
            text-align: left;
        }
        
        .hero-badge {
            display: inline-block;
            background-color: rgba(203, 181, 139, 0.85);
            color: #fff;
            font-size: 13px;
            padding: 5px 15px;
            border-radius: 30px;
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
    }
    
    /* Mobile hero styles */
    @media (max-width: 767px) {
        .mobile-hero-decoration-circle {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: rgba(203, 181, 139, 0.2);
            top: -50px;
            right: -50px;
            z-index: 1;
        }
        
        .mobile-hero-decoration-dots {
            position: absolute;
            width: 80px;
            height: 80px;
            background-image: radial-gradient(circle, #cbb58b 2px, transparent 3px);
            background-size: 15px 15px;
            top: 20px;
            left: 20px;
            z-index: 1;
        }
        
        .mobile-hero-badge {
            display: inline-block;
            background-color: rgba(203, 181, 139, 0.85);
            color: #fff;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .mobile-hero-scroll-hint {
            margin-top: 25px;
            opacity: 0.7;
            display: flex;
            align-items: center;
            font-size: 12px;
            animation: fadeInOut 2s infinite;
        }
        
        .mobile-hero-scroll-hint i {
            margin-left: 8px;
            font-size: 16px;
            animation: bounce 2s infinite;
        }
        
        @keyframes fadeInOut {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.9; }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-8px); }
            60% { transform: translateY(-4px); }
        }
    }
    
    /* Universal button styling with good contrast */
    .btn-hero {
        position: relative;
        display: inline-flex;
        align-items: center;
        padding: 10px 25px !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        letter-spacing: 0.5px !important;
        border-radius: 30px !important;
        overflow: hidden;
        z-index: 1;
        transition: all 0.3s ease !important;
        margin-right: 10px;
        margin-bottom: 10px;
        border: none !important;
        
        /* Gradient background for better contrast with any image */
        background: linear-gradient(135deg, #cbb58b 0%, #a08a63 100%) !important;
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    }
    
    .btn-hero:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #a08a63 0%, #8b7549 100%);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .btn-hero:hover:before {
        opacity: 1;
    }
    
    .btn-hero i {
        margin-right: 8px;
        font-size: 18px;
    }
    
    @media (max-width: 767px) {
        .btn-hero {
            padding: 8px 20px !important;
            font-size: 14px !important;
        }
        
        .btn-hero i {
            font-size: 16px;
        }
    }
    
    /* ============================================================ */
    /* FIXES FOR HEADER AND DROPDOWN ISSUES CAUSED BY CAROUSEL */
    /* ============================================================ */
    
    /* Ensure header affix behavior is not affected by carousel */
    .affix {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        left: 0 !important;
        z-index: 1030 !important;
        /* Prevent carousel containment from affecting header */
        contain: none !important;
        background-color: #fff !important;
        border-bottom: 1px solid #e6e6e6 !important;
        box-shadow: 0px 3px 12px -5px rgba(0, 0, 0, 0.2) !important;
    }
    
    /* Ensure dropdown menus work properly at all zoom levels */
    .dropdown-menu {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        z-index: 1000 !important;
        /* Prevent carousel containment from affecting dropdowns */
        contain: none !important;
        /* Ensure proper positioning even when page is zoomed */
        transform: none !important;
        will-change: auto !important;
    }
    
    /* Mobile header fixes */
    @media (max-width: 990px) {
        .affix {
            /* Ensure mobile header sticks properly */
            position: fixed !important;
            width: 100% !important;
            contain: none !important;
        }
        
        .navbar-collapse {
            /* Ensure mobile menu doesn't get affected by carousel containment */
            contain: none !important;
            z-index: 1040 !important;
        }
    }
    
    /* Desktop dropdown positioning fixes */
    @media (min-width: 991px) {
        .dropdown:hover > .dropdown-menu {
            visibility: visible !important;
            opacity: 1 !important;
            top: 45px !important;
            /* Ensure dropdowns work at all zoom levels */
            contain: none !important;
            position: absolute !important;
        }
        
        .dropdown .dropdown-menu {
            /* Reset any containment that might affect dropdown positioning */
            contain: none !important;
            position: absolute !important;
        }
    }
    
    /* ============================================================ */
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Create a comprehensive image preloading system
        var allImages = [];
        var loadedCount = 0;
        var totalImages = 0;
        var carouselInitialized = false;
        
        // Collect all images that need to be loaded
        $('.carousel-image, .preload-image').each(function() {
            var src = $(this).attr('src');
            if (src && allImages.indexOf(src) === -1) {
                allImages.push(src);
            }
        });
        
        totalImages = allImages.length;
        
        // Function to check if all images are loaded
        function checkAllImagesLoaded() {
            if (loadedCount >= totalImages && !carouselInitialized) {
                carouselInitialized = true;
                console.log('All images preloaded, initializing carousel...');
                initCarousel();
            }
        }
        
        // Preload all images
        if (totalImages > 0) {
            allImages.forEach(function(src, index) {
                var img = new Image();
                img.onload = function() {
                    loadedCount++;
                    console.log('Image loaded: ' + (loadedCount) + '/' + totalImages);
                    checkAllImagesLoaded();
                };
                img.onerror = function() {
                    loadedCount++; // Count errors too to avoid hanging
                    console.log('Image error: ' + (loadedCount) + '/' + totalImages);
                    checkAllImagesLoaded();
                };
                img.src = src;
            });
        } else {
            initCarousel(); // No images to load
        }
        
        // Fallback timeout - initialize carousel after 3 seconds even if images aren't loaded
        setTimeout(function() {
            if (!carouselInitialized) {
                console.log('Timeout reached, forcing carousel initialization...');
                carouselInitialized = true;
                initCarousel();
            }
        }, 3000);
        
        function initCarousel() {
            // Add loading overlay removal
            $('.slider_img').removeClass('loading');
            
            // Disable auto-sliding on mobile devices
            if ($(window).width() < 768) {
                $('#homeCarousel').carousel({
                    interval: false
                });
            } else {
                // Force carousel to auto-slide on desktop with fade transition
                $('#homeCarousel').carousel('dispose');
                
                // Create new carousel with crossfade transition
                $('#homeCarousel').carousel({
                    interval: 7000,
                    pause: false, // Don't pause on hover
                    wrap: true
                });
                
                // Prevent layout shifts during transitions - but scoped to carousel only
                $('#homeCarousel').on('slide.bs.carousel', function (e) {
                    // Temporarily disable overflow only on carousel container, not body
                    $('#homeCarousel').css('overflow', 'hidden');
                });
                
                $('#homeCarousel').on('slid.bs.carousel', function (e) {
                    // Re-enable overflow after transition completes - scoped to carousel
                    setTimeout(function() {
                        $('#homeCarousel').css('overflow', '');
                    }, 100);
                });
                
                // Force start the carousel
                $('#homeCarousel').carousel('cycle');
                
                // Make sure URL hash doesn't interfere with auto-sliding
                if (window.location.hash) {
                    history.replaceState("", document.title, window.location.pathname + window.location.search);
                }
                
                // Add a persistent check to ensure carousel keeps running
                var carouselChecker = setInterval(function() {
                    var carousel = $('#homeCarousel').data('bs.carousel');
                    if (carousel && !carousel._interval) {
                        $('#homeCarousel').carousel('cycle');
                    }
                }, 3000);
            }
        }
    });
</script>
@endpush