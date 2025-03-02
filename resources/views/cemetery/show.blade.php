@extends('Layout.master')

@section('Show-Books')
<main class="container">
    <div class="card">
        <div class="user-info">
            @if($cemetry->image)
                <img src="{{ asset('uploads/cemeteryimages/' . $cemetry->image) }}" class="profile-img">
            @else
                <img src="{{ asset('uploads/cemeteryimages/2.jpg') }}" class="profile-img">
            @endif
            <h3>{{ $cemetry->name }}</h3>
            <p class="desc">{{ $cemetry->description ?? 'لا يوجد وصف' }}</p>
        </div>

        <div class="auth-details">

            <h4>الموقع</h4>
            <p>{{ $cemetry->location }}</p>

            <h4>الإحداثيات</h4>
            <p>خط العرض: {{ $cemetry->lat ?? 'غير متوفر' }} - خط الطول: {{ $cemetry->long ?? 'غير متوفر' }}</p>

            <h4>الحجم</h4>
            <p>{{ $cemetry->size }} م²</p>

            <h4>السعر</h4>
            <p>{{ $cemetry->price }} $</p>

            <h4>الخصم</h4>
            <p>{{ $cemetry->is_discount ? $cemetry->discount . '%' : 'لا يوجد خصم' }}</p>

            <h4>تمت الإضافة بواسطة</h4>
            <p>{{ $cemetry->user->name }}</p>

        </div>

        <div class="buttons-container">
            <a href="{{route('cemetery.edit', $cemetry->id)}}" class="edit">تعديل</a>
            <a href="{{ route('cemetery.index')}}" class="cancel">رجوع</a>
        </div>
    </div>
</main>

@endsection
