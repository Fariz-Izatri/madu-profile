<section>
  <div class="slider_img layout_two">
      <div id="carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
              @foreach($heroSlides as $index => $slide)
                  <li data-target="#carousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
              @endforeach
          </ol>
          <div class="carousel-inner" role="listbox">
              @foreach($heroSlides as $index => $slide)
                  <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                      @if(Str::startsWith($slide->image, 'images/'))
                          <img class="d-block" src="{{ asset($slide->image) }}" alt="Slide {{ $index + 1 }}">
                      @else
                          <img class="d-block" src="{{ $slide->image }}" alt="Slide {{ $index + 1 }}">
                      @endif
                      <div class="carousel-caption d-md-block">
                          <div class="slider_title">
                              <h1>{{ $slide->title }}</h1>
                              <h4>{!! nl2br(e($slide->subtitle)) !!}</h4>
                              <div class="slider-btn">
                                  @if($slide->button_text && $slide->button_link)
                                      <a href="{{ url($slide->button_link) }}" class="btn btn-default">{{ $slide->button_text }}</a>
                                  @endif
                                  @if($slide->content && isset(json_decode($slide->content, true)['buttons']))
                                      @foreach(json_decode($slide->content, true)['buttons'] as $button)
                                          <a href="{{ url($button['link']) }}" class="btn btn-default">{{ $button['text'] }}</a>
                                      @endforeach
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
          <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
              <i class="icon-arrow-left fa-slider" aria-hidden="true"></i>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
              <i class="icon-arrow-right fa-slider" aria-hidden="true"></i>
              <span class="sr-only">Next</span>
          </a>
      </div>
  </div>
</section> 