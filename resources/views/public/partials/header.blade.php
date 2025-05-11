<!-- ========================= ABOUT IMAGE =========================-->
<div class="about_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/') }}"><img src="{{ asset('images/responsive-logo.png') }}" class="responsive-logo img-fluid" alt="responsive-logo"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                        <span class="icon-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/about') }}">About
                                    @if(request()->is('about'))
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('admission-form') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/admission-form') }}">Admissions</a>
                            </li>
                            <li class="nav-item {{ request()->is('academics') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/academics') }}">Academics</a>
                            </li>
                            <li class="nav-logo">
                                <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="logo"></a>
                            </li>
                            <li class="nav-item {{ request()->is('research') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/research') }}">Research</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pages
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/index-2') }}">Home Style Two</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/index-video') }}">Home Video</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/blog') }}">Blog</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/blog-post') }}">Blog Post</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/index-landing-page') }}">Landing Page</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/events') }}">Events</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/course-detail') }}">Course Details</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/campus-life') }}">Campus Life</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/our-teachers') }}">Our Teachers</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/teachers-single') }}">Teachers Single</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/gallery') }}">Gallery</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/shortcodes') }}">Shortcodes</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Others Pages</a>
                                        <ul class="dropdown-menu dropdown-menu1">
                                            <li><a class="dropdown-item" href="{{ url('/notice-board') }}">Notice Board</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/chairman-speech') }}">Chairman Speech</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/sample-page') }}">Sample Page</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/faq') }}">FAQ</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/login') }}">Login</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/sign-up') }}">Sign Up</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/coming-soon') }}">Coming Soon</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>@yield('page_title', 'About Us')</h1>
            </div>
        </div>
    </div>
</div>
<!--//END ABOUT IMAGE -->