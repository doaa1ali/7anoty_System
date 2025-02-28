@extends('Layout.master')

@section('Show-Books')
<main class="container">
    <div class="card">
        <div class="user-info">
            @if ($service->image)
                <img src="{{ asset('uploads/servicesimage/' . $service->image) }}" class="profile-img">
            @else
                <img src="{{ asset('uploads/servicesimage/services.jpg') }}" class="profile-img">
            @endif
            <h3>{{ $service->name }}</h3>
            <span class="email">{{ $service->location }}</span>
        </div>

        <div class="auth-details">
            <h4>وصف الخدمة</h4>
            <p>{{ $service->description }}</p>

            <h4>السعر</h4>
            <p>{{ $service->price }} جنيه</p>

            <h4>وقت البدء</h4>
            <p>{{ $service->start_time }}</p>

            <h4>وقت الانتهاء</h4>
            <p>{{ $service->end_time }}</p>

            <h4>هل يوجد خصم؟</h4>
            <p>{{ $service->is_discount ? 'نعم' : 'لا' }}</p>

            @if ($service->is_discount)
                <h4>قيمة الخصم</h4>
                <p>{{ $service->discount }} جنيه</p>
            @endif
        </div>

        <div class="buttons-container">
            <a href="{{ route('service.edit', $service->id) }}" class="edit">تعديل</a>
            <a href="{{ route('service.index') }}" class="cancel">رجوع</a>
        </div>
    </div>
</main>
@endsection
