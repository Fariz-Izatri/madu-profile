<section class="our-teachers">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Apa Kata Lulusan</h2>
        </div>
    </div>
    <div class="row">
        @forelse($testimoni as $testi)
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="our-teachers-block">
                    @if($testi->image)
                        <img src="{{ asset($testi->image) }}" class="img-fluid teachers-img" alt="{{ $testi->author_name }}">
                    @else
                        <img src="{{ asset('images/our-teachers_01.jpg') }}" class="img-fluid teachers-img" alt="{{ $testi->author_name }}">
                    @endif
                    <div class="teachers-description">
                        <h6>"{{ $testi->title }}"</h6>
                        <hr />
                        <p><strong>{{ $testi->author_name }}</strong></p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="our-teachers-block">
                    <img src="{{ asset('images/our-teachers_01.jpg') }}" class="img-fluid teachers-img" alt="#">
                    <div class="teachers-description">
                        <h6>"Belajar dari yang terbaik, bersama yang terbaik, dari yang terbaik"</h6>
                        <hr />
                        <p><strong>Karen Angela</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="our-teachers-block">
                    <img src="{{ asset('images/our-teachers_02.jpg') }}" class="img-fluid teachers-img" alt="#">
                    <div class="teachers-description">
                        <h6>"Belajar dari yang terbaik, bersama yang terbaik, dari yang terbaik"</h6>
                        <hr />
                        <p><strong>Raymond Salazar</strong></p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <!-- End row -->
</div>
</section>