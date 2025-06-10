<section class="admission_cources">
  <div class="container">
      <div class="row text-center">
          <div class="col-md-12">
              <div class="section-title">
                  <div class="title-decoration d-none d-sm-block">
                      <div class="decoration-circle"></div>
                      <div class="decoration-line"></div>
                  </div>
                  <h2>{{ $info->title }}</h2>
                  <p class="section-description mb-4">{{ json_decode($info->content, true)['description'] ?? '' }}</p>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="info-image-container">
                  @if(Str::startsWith($info->image, 'images/'))
                      <img src="{{ asset($info->image) }}" class="img-fluid" alt="{{ $info->title }}">
                  @else
                      <img src="{{ $info->image }}" class="img-fluid" alt="{{ $info->title }}">
                  @endif
                  <div class="info-image-overlay">
                      <div class="info-image-icon">
                          <i class="icon-graduation"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<style>
    /* Styled section title with decorative elements */
    .section-title {
        position: relative;
        margin-bottom: 30px;
    }
    
    .title-decoration {
        position: relative;
        height: 30px;
        margin-bottom: 15px;
    }
    
    .decoration-circle {
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: #cbb58b;
        border-radius: 50%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    
    .decoration-line {
        position: absolute;
        width: 60px;
        height: 2px;
        background-color: #cbb58b;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    
    /* Section title styling for all screen sizes */
    .section-title h2 {
        font-size: 35px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 15px;
        padding-bottom: 15px;
        position: relative;
    }
    
    .section-title h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background-color: #cbb58b;
    }
    
    .section-description {
        font-size: 17px;
        line-height: 1.7;
        color: #666;
        max-width: 800px;
        margin: 0 auto;
    }
    
    /* Enhanced image container */
    .info-image-container {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .info-image-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .info-image-container img {
        width: 100%;
        transition: all 0.5s ease;
    }
    
    .info-image-container:hover img {
        transform: scale(1.02);
    }
    
    /* Image overlay with icon */
    .info-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 20px;
    }
    
    .info-image-container:hover .info-image-overlay {
        opacity: 1;
    }
    
    .info-image-icon {
        width: 60px;
        height: 60px;
        background-color: #cbb58b;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transform: translateY(20px);
        transition: all 0.3s ease 0.1s;
    }
    
    .info-image-container:hover .info-image-icon {
        transform: translateY(0);
    }
    
    .info-image-icon i {
        font-size: 24px;
        color: white;
    }
    
    @media (max-width: 767px) {
        .admission_cources {
            position: relative;
        }
        
        .admission_cources:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(to bottom, rgba(247, 247, 247, 1) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
        }
        
        .section-title h2 {
            font-size: 28px;
        }
        
        .section-description {
            font-size: 16px;
        }
        
        .info-image-container {
            margin-top: 20px;
            transform: translateY(0);
            transition: transform 0.3s ease;
        }
        
        .info-image-container:active {
            transform: translateY(-5px);
        }
        
        /* Hide overlay on mobile, use active state instead */
        .info-image-overlay {
            display: none;
        }
    }
</style> 