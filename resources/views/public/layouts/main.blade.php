<!-- filepath: resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Unisco - Education Website')</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- Simple Line Font -->
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- Main CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Custom Image Sizes CSS -->
    <link href="{{ asset('css/custom-image-sizes.css') }}?v={{ time() }}" rel="stylesheet">
    <!-- Mobile Fixes CSS - Load last to override existing styles -->
    <link href="{{ asset('css/mobile-fixes.css') }}?v={{ time() }}" rel="stylesheet">
    <!-- Spacing Fixes CSS - Highest priority -->
    <link href="{{ asset('css/spacing-fix.css') }}?v={{ time() }}" rel="stylesheet">
    <!-- Emergency mobile hero fix - Absolute highest priority -->
    <link href="{{ asset('css/mobile-hero-fix.css') }}?v={{ time() }}" rel="stylesheet">
    
    @stack('styles')
</head>

<body>
    <!-- Header -->
    @include('public.partials.header')
    
    <!-- Check if a custom header has been defined for this page -->
    @hasSection('header')
        @yield('header') 
    @else
        @include('public.partials.heroAction')
    @endif
    
    <!-- Main Content -->
    @hasSection('content')
        @yield('content')
    @else
        <div class="container">
            <div class="row" style="text-align: center; margin-top: 50px; margin-bottom: 50px;">
                <div class="col-md-12">
                    <h1>Coming Soon</h1>
                </div>
            </div>
        </div>
    @endif
 
    <!-- Instagram Feed Section (if needed) -->
    @hasSection('show_instagram')
    <div id="instafeed"></div>
    @endif
    
    <!-- Footer Section -->
    @include('public.partials.footer')
    
    <!-- jQuery, Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    <!-- Plugins -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/counterup.min.js') }}"></script>
    <script src="{{ asset('js/instafeed.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
    <script src="{{ asset('js/tweetie.min.js') }}"></script>
    
    <!-- Subscribe -->
    <script src="{{ asset('js/subscribe.js') }}"></script>
    
    <!-- Script JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    
    @stack('scripts')
</body>
</html>