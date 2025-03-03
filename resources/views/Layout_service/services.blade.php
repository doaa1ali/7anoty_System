<section class="cemetery-section">
    <div class="section-header">
        <h2>أحدث الخدمات</h2>
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
</section>