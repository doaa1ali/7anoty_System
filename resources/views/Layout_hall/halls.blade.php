<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث القاعات</h2>
        <a href="#" class="more-btn">
            <span>استعرض المزيد</span>
            <i class="arrow-icon">&larr;</i>
        </a>
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
                    <a href="#" class="btn">حجز الآن</a>
                </div>
            </div>
        @endforeach
    </div> 
</section>