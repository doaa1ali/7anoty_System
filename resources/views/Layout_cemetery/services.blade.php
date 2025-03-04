
<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث المقابر</h2>
        <form method="GET" action="{{ route('Search_Cemeteries') }}" class="search-form">
        <input type="text" name="location" placeholder="ابحث بالموقع..." value="{{ request('location') }}">
        <button type="submit">بحث</button>
    </form>
    </div>
    <div class="cemetery-container">
        @foreach ($Cemeteries as $cemetery)
            <div class="cemetery-card">
                @if($cemetery->image)
                    <img src="{{ asset('uploads/cemeteryimages/' . $cemetery->image) }}">
                @else
                    <p><img src="{{ asset('uploads/cemeteryimages/2.jpg') }}" ></p>

                @endif
                <div class="cemetery-info">
                    <h3>{{ $cemetery->name }}</h3>
                    <p><strong>الموقع:</strong> {{ $cemetery->location }}</p>
                    <p><strong>عدد الأماكن المتاحة:</strong> {{ $cemetery->available_places }}</p>
                    <p><strong>السعر:</strong> {{ number_format($cemetery->price) }} جنيه</p>
                    <form action="{{ route('cart.add', ['type' => 'cemetery']) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cemetery->id }}">
                    <button type="submit" class="btn">حجز الآن</button>
                </form>
                </div>
            </div>
        @endforeach
    </div> 



    @php
        $currentPage = $Cemeteries->currentPage(); 
        $lastPage = $Cemeteries->lastPage(); 
        $start = max($currentPage - 1, 1); 
        $end = min($start + 9, $lastPage); 
    @endphp

<div class="pagination">
    @if ($Cemeteries->onFirstPage())
        <span class="page-link disabled">السابق</span>
    @else
        <a class="page-link" href="{{ $Cemeteries->previousPageUrl() }}">السابق</a>
    @endif

    @for ($page = $start; $page <= $end; $page++)
        @if ($page == $currentPage)
            <span class="page-link active">{{ $page }}</span>
        @else
            <a class="page-link" href="{{ $Cemeteries->url($page) }}">{{ $page }}</a>
        @endif
    @endfor

    @if ($end < $lastPage)
        <a class="page-link" href="{{ $Cemeteries->nextPageUrl() }}">التالي</a>
    @else
        <span class="page-link disabled">التالي</span>
    @endif
</div>
</section>
