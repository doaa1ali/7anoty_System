<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث القاعات</h2>
        <form method="GET" action="{{ route('Search_halls') }}" class="search-form">
            <input type="text" name="location" placeholder="ابحث بالموقع..." value="{{ request('location') }}">
            <button type="submit">بحث</button>
        </form>
    </div>
    <div class="cemetery-container">
        @foreach ($halls as $hall)
            <div class="cemetery-card">
                <img src="{{ asset('uploads/hallimages/hall2.jpg') }}">
                <div class="cemetery-info">
                    <h3>{{ $hall->name }}</h3>
                    <p><strong>الموقع:</strong> {{ $hall->location }}</p>
                    <p><strong>السعة:</strong> {{ $hall->seats }} شخص</p>
                    <p><strong>السعر:</strong> {{ number_format($hall->price) }} جنيه</p>
                    <p><strong>وقت البداية:</strong> {{ $hall->start_time }}</p>
                    <p><strong>وقت النهاية:</strong> {{ $hall->end_time }}</p>
                    <p><strong>بوفيه:</strong> {{ $hall->has_buffet ? 'متوفر' : 'غير متوفر' }}</p>
                    <button type="button" class="btn" 
                        onclick="addToCart({ 
                            id: {{ $hall->id }}, 
                            name: '{{ $hall->name }}', 
                            price: {{ $hall->price }}, 
                            type: 'hall' 
                        })">
                        حجز الآن
                    </button>


                </div>
            </div>
        @endforeach
    </div> 

    @php
        $currentPage = $halls->currentPage(); 
        $lastPage = $halls->lastPage(); 
        $start = max($currentPage - 1, 1); 
        $end = min($start + 9, $lastPage); 
    @endphp

<div class="pagination">
    @if ($halls->onFirstPage())
        <span class="page-link disabled">السابق</span>
    @else
        <a class="page-link" href="{{ $halls->previousPageUrl() }}">السابق</a>
    @endif

    @for ($page = $start; $page <= $end; $page++)
        @if ($page == $currentPage)
            <span class="page-link active">{{ $page }}</span>
        @else
            <a class="page-link" href="{{ $halls->url($page) }}">{{ $page }}</a>
        @endif
    @endfor

    @if ($end < $lastPage)
        <a class="page-link" href="{{ $halls->nextPageUrl() }}">التالي</a>
    @else
        <span class="page-link disabled">التالي</span>
    @endif
</div>




</section>


