<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="subscribe">
                    <h3>Newsletter</h3>
                    <form id="subscribeform" action="#" method="post">
                        @csrf
                        <input class="signup_form" type="text" name="email" placeholder="Enter Your Email Address">
                        <button type="submit" class="btn btn-warning" id="js-subscribe-btn">SUBSCRIBE</button>
                        <div id="js-subscribe-result" data-success-msg="Success, Please check your email." data-error-msg="Oops! Something went wrong"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="foot-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/footer-logo.png') }}" class="img-fluid" alt="footer_logo">
                    </a>
                    <p>{{ date('Y') }} © copyright
                        <br> All rights reserved.</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="sitemap">
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/admission-form') }}">Admissions </a></li>
                        <li><a href="{{ url('/academics') }}">Academics</a></li>
                        <li><a href="{{ url('/research') }}">Research</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tweet_box">
                    <h3>Tweets</h3>
                    <div class="tweet-wrap">
                        <div class="tweet"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="address">
                    <h3>Contact us</h3>
                    <p><span>Address: </span> Unisco university Albany, NY, USA. 11001</p>
                    <p>Email : info@unisco.com
                        <br> Phone : +91 555 668 986</p>
                    <ul class="footer-social-icons">
                        <li><a href="#"><i class="fa fa-facebook fa-fb" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin fa-in" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter fa-tw" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--//END FOOTER -->