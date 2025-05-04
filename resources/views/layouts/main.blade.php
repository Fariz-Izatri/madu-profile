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
    
    @stack('styles')
</head>

<body>
    <!-- Check if a custom header has been defined for this page -->
    @hasSection('header')
        @yield('header')
    @else
        @include('partials.header')
    @endif
    
    <!-- Main Content -->
    @yield('content')
    
    <!-- Instagram Feed Section (if needed) -->
    @hasSection('show_instagram')
    <div id="instafeed"></div>
    @endif
    
    <!-- Footer Section -->
    @include('partials.footer')
    
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