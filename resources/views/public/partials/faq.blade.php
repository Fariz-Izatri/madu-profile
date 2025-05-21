<div class="faq">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">{{ $faq->title ?? 'FAQ' }}</h2>
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
                                        No FAQ items available
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseEmpty" class="collapse show" role="tabpanel" aria-labelledby="headingEmpty">
                                <div class="card-block">
                                    <p>No FAQ items have been added yet.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div> 