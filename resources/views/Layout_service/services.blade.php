<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث الخدمات</h2>
        <form method="GET" action="{{ route('Search_services') }}" class="search-form">
            <input type="text" name="location" placeholder="ابحث بالموقع..." value="{{ request('location') }}">
            <button type="submit">بحث</button>
        </form>
    </div>
    <div class="cemetery-container">
        @foreach ($services as $hall)
            <div class="cemetery-card">
            <img src="{{ asset('uploads/servicesimage/1.webp') }}">
                <div class="cemetery-info">
                    <h3>{{ $hall->name }}</h3>
                    <p><strong>الموقع:</strong> {{ $hall->location }}</p>
                    <p><strong>السعر:</strong> {{ number_format($hall->price) }} جنيه</p>
                    <p><strong>وقت البداية:</strong> {{ $hall->start_time }}</p>
                    <p><strong>وقت النهاية:</strong> {{ $hall->end_time }}</p>
                    <form action="{{ route('cart.add', ['type' => 'service']) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $hall->id }}">
                        <button type="submit" class="btn">حجز الآن</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div> 

    @php
        $currentPage = $services->currentPage(); 
        $lastPage = $services->lastPage(); 
        $start = max($currentPage - 1, 1); 
        $end = min($start + 9, $lastPage); 
    @endphp

<div class="pagination">
    @if ($services->onFirstPage())
        <span class="page-link disabled">السابق</span>
    @else
        <a class="page-link" href="{{ $services->previousPageUrl() }}">السابق</a>
    @endif

    @for ($page = $start; $page <= $end; $page++)
        @if ($page == $currentPage)
            <span class="page-link active">{{ $page }}</span>
        @else
            <a class="page-link" href="{{ $services->url($page) }}">{{ $page }}</a>
        @endif
    @endfor

    @if ($end < $lastPage)
        <a class="page-link" href="{{ $services->nextPageUrl() }}">التالي</a>
    @else
        <span class="page-link disabled">التالي</span>
    @endif
</div>
</section>