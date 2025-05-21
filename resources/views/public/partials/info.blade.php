<section class="admission_cources">
  <div class="container">
      <div class="row text-center">
          <div class="col-md-12">
              <h2>{{ $info->title }}</h2>
              <p class="mb-4">{{ json_decode($info->content, true)['description'] ?? '' }}</p>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              @if(Str::startsWith($info->image, 'images/'))
                  <img src="{{ asset($info->image) }}" class="img-fluid" alt="{{ $info->title }}">
              @else
                  <img src="{{ $info->image }}" class="img-fluid" alt="{{ $info->title }}">
              @endif
          </div>
      </div>
  </div>
</section> 