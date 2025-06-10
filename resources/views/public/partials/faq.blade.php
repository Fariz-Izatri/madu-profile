<div class="tanya-jawab">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ $faq->title ?? 'Tanya Jawab' }}</h2>
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    @forelse($faqItems as $index => $item)
                        <div class="card">
                            <div class="card-header" role="tab" id="heading{{ $index }}">
                                <h5 class="mb-0">
                                    <a class="{{ !($item['is_open'] ?? false) ? 'collapsed ' : '' }}accordian-link" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $index }}" aria-expanded="{{ ($item['is_open'] ?? false) ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                        {{ $item['question'] }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse{{ $index }}" class="collapse {{ ($item['is_open'] ?? false) ? 'show' : '' }}" role="tabpanel" aria-labelledby="heading{{ $index }}">
                                <div class="card-block">
                                    {!! nl2br(e($item['answer'])) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-header" role="tab" id="headingEmpty">
                                <h5 class="mb-0">
                                    <a class="accordian-link" data-toggle="collapse" data-parent="#accordion" href="#collapseEmpty" aria-expanded="true" aria-controls="collapseEmpty">
                                        Belum ada pertanyaan
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseEmpty" class="collapse show" role="tabpanel" aria-labelledby="headingEmpty">
                                <div class="card-block">
                                    <p>Belum ada pertanyaan dan jawaban yang ditambahkan.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tanya-jawab {
        padding: 60px 0;
        background-color: #f9f9f9;
    }
    
    .tanya-jawab h2 {
        margin-bottom: 40px;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
        color: #2d2d2d;
        font-weight: 700;
        text-align: center;
    }
    
    .tanya-jawab h2:after {
        content: "";
        position: absolute;
        width: 50px;
        height: 3px;
        background: #cbb58b;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .tanya-jawab .card {
        border: none;
        margin-bottom: 15px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .tanya-jawab .card-header {
        padding: 0;
        background-color: #fff;
        border: none;
    }
    
    .tanya-jawab .accordian-link {
        display: block;
        padding: 15px 20px;
        color: #333;
        font-weight: 600;
        text-decoration: none;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .tanya-jawab .accordian-link:after {
        content: "\f078";
        font-family: "Font Awesome 5 Free";
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .tanya-jawab .accordian-link.collapsed:after {
        content: "\f054";
    }
    
    .tanya-jawab .accordian-link:hover {
        background-color: #f5f5f5;
    }
    
    .tanya-jawab .card-block {
        padding: 15px 20px 20px;
        line-height: 1.6;
        color: #666;
    }
    
    /* Mobile adjustments */
    @media (max-width: 767px) {
        .tanya-jawab {
            padding: 40px 0;
        }
        
        .tanya-jawab h2 {
            margin-bottom: 30px;
        }
    }
</style> 