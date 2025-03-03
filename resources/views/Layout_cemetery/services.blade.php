<section class="reciter-section">
    <div class="sections-header">
        <h2>نتيجة البحث</h2>
    </div>
    </section>
    <section class="cemetery-section">
        <div class="section-header">
            <h2>أحدث المقابر</h2>
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
                        <a href="#" class="btn">حجز الان</a>
                    </div>
                </div>
            @endforeach
        </div> 
    </section>
</section>
