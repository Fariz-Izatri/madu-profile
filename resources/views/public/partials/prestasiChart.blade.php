<!--============================= DETAILED CHART =============================-->
<div class="detailed_chart">
  <div class="container">
      <div class="row">
          @forelse($chartItems as $item)
            <div class="col-xs-12 col-sm-6 col-md-3 {{ $loop->index % 2 != 0 ? 'chart_top' : 'chart_bottom' }}">
                <div class="chart-img">
                    <img src="{{ asset('images/' . ($item['icon'] ?? 'chart-icon_1.png')) }}" class="img-fluid" alt="{{ $item['label'] ?? 'chart_icon' }}">
                </div>
                <div class="chart-text">
                    <p><span class="counter">{{ $item['count'] ?? 0 }}</span> {{ $item['label'] ?? '' }}
                    </p>
                </div>
            </div>
          @empty
            <div class="col-xs-12 col-sm-6 col-md-3 chart_bottom">
                <div class="chart-img">
                    <img src="{{ asset('images/chart-icon_1.png') }}" class="img-fluid" alt="chart_icon">
                </div>
                <div class="chart-text">
                    <p><span class="counter">39</span> Guru
                    </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 chart_bottom chart_top">
                <div class="chart-img">
                    <img src="{{ asset('images/chart-icon_2.png') }}" class="img-fluid" alt="chart_icon">
                </div>
                <div class="chart-text">
                    <p><span class="counter">2600</span> Murid
                    </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 chart_top">
                <div class="chart-img">
                    <img src="{{ asset('images/chart-icon_3.png') }}" class="img-fluid" alt="chart_icon">
                </div>
                <div class="chart-text">
                    <p><span class="counter">23</span> Extrakurikuler
                    </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="chart-img">
                    <img src="{{ asset('images/chart-icon_4.png') }}" class="img-fluid" alt="chart_icon">
                </div>
                <div class="chart-text">
                    <p><span class="counter">13</span> Medali</p>
                </div>
            </div>
          @endforelse
      </div>
  </div>
</div>
<!--//END DETAILED CHART -->