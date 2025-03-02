<section class="main-services">
    <h2>الخدمات الرئيسية</h2>
    
    <div class="services-container">
        
        <div class="service-card">
            <img src="{{ asset('uploads/ImageWebsite/11.jpg') }}" alt="تجهيز الجنازات">
            <h3>تجهيز الجنازات</h3>
            <p>نوفر خدمات تجهيز الجنازات بكل احترام واهتمام بجميع التفاصيل.</p>
            <a href="#" class="btn">المزيد</a>
        </div>

        <div class="service-card">
            <img src="{{ asset('uploads/ImageWebsite/9.jpg') }}" alt="حجز المقابر">
            <h3>حجز المقابر</h3>
            <p>توفير مقابر مهيأة بأفضل الأسعار في مواقع متعددة.</p>
            <a href="{{route('cemetery')}}" class="btn">المزيد</a>
        </div>

        <div class="service-card">
            <img src="{{ asset('uploads/ImageWebsite/10.jpg') }}" alt="خدمات العزاء">
            <h3>خدمات العزاء والمواساة</h3>
            <p>تنظيم العزاء وتقديم الدعم والمواساة للعائلات .</p>
            <a href="{{route('hall')}}" class="btn">المزيد</a>
        </div>

        <div class="service-card">
            <img src="{{ asset('uploads/ImageWebsite/12.jpg') }}" alt="خدمات العزاء">
            <h3>خدمات القراء</h3>
            <p>توفير قراء لتلاوة القرآن الكريم في العزاء والمناسبات الدينية بكل وقار واحترام.</p>
            <a href="#" class="btn">المزيد</a>
        </div>

    </div> 

</section>
<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث المقابر</h2>
        <a href="{{route('cemetery')}}" class="more-btn">
            <span>استعرض المزيد</span>
            <i class="arrow-icon">&larr;</i>
        </a>
    </div>
    <div class="cemetery-container">
        @foreach ($Cemeteries->take(3) as $cemetery)
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
                    <form action="{{ route('cart.add', $cemetery->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn">حجز الآن</button>
                    </form>

                </div>
            </div>
        @endforeach
    </div> 
</section>

<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث القاعات</h2>
        <a href="{{route('hall')}}" class="more-btn">
            <span>استعرض المزيد</span>
            <i class="arrow-icon">&larr;</i>
        </a>
    </div>
    <div class="cemetery-container">
        @foreach ($halls->take(3) as $hall)
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
                    <a href="{{ route('cart.add', $hall->id) }}" class="btn">حجز الآن</a>
                </div>
            </div>
        @endforeach
    </div> 
</section>

