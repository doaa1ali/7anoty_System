<style>
    .Hero_section{
    background: url("{{ asset('uploads/ImageWebsite/8.jpg') }}"); 

    }

</style>
<div class="main">
    <div class='Hero_section'>
        <div class='Hero_section_content'>
            <h1>الحانوتي</h1>
            <p>نحن هنا لدعمك في الأوقات الصعبة، خدمات جنائزية متكاملة بكل احترام وعناية.</p>
            <a href="{{route('service')}}" class="btn">طلب خدمة الآن</a>
            <a href="{{ route('cart.index') }}" class="btn btn-warning text-white px-4 py-2 d-flex align-items-center" style="font-size: 1rem;  border-radius: 10px;">
            <i class="fas fa-shopping-cart me-2"></i> سلة المشتريات
        </a>
        </div>

    </div>

</div>