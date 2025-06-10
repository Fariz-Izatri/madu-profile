<section class="event">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Visi & Misi</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="date-description ml-0">
                                <h3>Visi</h3>
                                <p>{{ $sejarah->visi ?? 'Informasi visi belum tersedia.' }}</p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-6">
                <h2 style="color: transparent; cursor:default">...........</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="date-description ml-0">
                                <h3>Misi</h3>
                                <p>{!! nl2br(e($sejarah->misi ?? 'Informasi misi belum tersedia.')) !!}</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>