@php
    // Get only the first active slide for mobile view
    $firstSlide = $heroSlides->first();
@endphp

<section>
  <div class="slider_img layout_two">
      <!-- Desktop Carousel - Enhanced with modern UI -->
      <div id="homeCarousel" class="carousel slide d-none d-md-block" data-ride="carousel" data-interval="7000">
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
                              <img class="d-block carousel-image" src="{{ asset($slide->image) }}" alt="Slide {{ $index + 1 }}">
                          @else
                              <img class="d-block carousel-image" src="{{ $slide->image }}" alt="Slide {{ $index + 1 }}">
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
                  <img class="d-block w-100" src="{{ asset($firstSlide->image) }}" alt="Mobile Hero">
              @else
                  <img class="d-block w-100" src="{{ $firstSlide->image }}" alt="Mobile Hero">
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
      <div style="display: none;">
          @foreach($heroSlides as $slide)
              @if(Str::startsWith($slide->image, 'images/'))
                  <img src="{{ asset($slide->image) }}" alt="Preload">
              @else
                  <img src="{{ $slide->image }}" alt="Preload">
              @endif
          @endforeach
      </div>
  </div>
</section>

@push('styles')
<style>
    /* Enhanced hero styling for both mobile and desktop */
    
    /* Fix for transition flash - use transparent background */
    #homeCarousel, 
    .carousel-inner, 
    .carousel-item {
        background: transparent !important;
    }
    
    /* Ensure images cover the entire area */
    .carousel-image {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }
    
    /* Prevent flash with better transition */
    .carousel .carousel-item {
        transition: transform 0.6s ease !important;
        -webkit-transition: transform 0.6s ease !important;
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
    }
    
    /* Desktop hero styles */
    @media (min-width: 768px) {
        .carousel-item {
            position: relative;
            overflow: hidden;
        }
        
        .carousel-item img {
            filter: brightness(0.9);
            transition: transform 8s ease;
        }
        
        .carousel-item.active img {
            transform: scale(1.05);
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
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Ensure all images are loaded before carousel starts
        var images = $('.carousel-image');
        var loadedImages = 0;
        
        images.each(function() {
            if (this.complete) {
                loadedImages++;
                if (loadedImages === images.length) {
                    initCarousel();
                }
            } else {
                $(this).on('load', function() {
                    loadedImages++;
                    if (loadedImages === images.length) {
                        initCarousel();
                    }
                });
                
                // Handle error case
                $(this).on('error', function() {
                    loadedImages++;
                    if (loadedImages === images.length) {
                        initCarousel();
                    }
                });
            }
        });
        
        // If no images or all cached, still init
        if (images.length === 0 || loadedImages === images.length) {
            initCarousel();
        }
        
        function initCarousel() {
            // Disable auto-sliding on mobile devices
            if ($(window).width() < 768) {
                $('#homeCarousel').carousel({
                    interval: false
                });
            } else {
                // Force carousel to auto-slide on desktop
                $('#homeCarousel').carousel('dispose');
                
                // Create new carousel with auto-sliding
                $('#homeCarousel').carousel({
                    interval: 7000,
                    pause: false // Don't pause on hover
                });
                
                // Force start the carousel (ignoring URL hash)
                $('#homeCarousel').carousel('cycle');
                
                // Make sure URL hash doesn't interfere with auto-sliding
                if (window.location.hash) {
                    // Remove the hash to prevent it from affecting the carousel
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