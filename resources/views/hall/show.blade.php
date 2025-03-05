
@extends('Layout.master')

@section('Show-Books')
<main class="container">
    <div class="card">
        <div class="user-info">
            <!-- @if($hall->image)
                <img src="{{ asset('uploads/hallimages/' . $hall->image) }}" class="profile-img">
            @else                   
                <img src="{{ asset('uploads/hallimages/hall2.jpg') }}" class="profile-img">
            @endif -->

            <img src="{{ asset('uploads/hallimages/hall2.jpg') }}" class="profile-img">
            <h3>{{ $hall->name }}</h3>
            <span class="description">{{ $hall->description}}</span>
        </div>
        <div class="auth-details">

        <h4>الموقع</h4>
            <p>{{ $hall->location }}</p>

       
            <h4>السعر</h4>
            <p class="price">{{$hall->price}}</p>

            <h4>عدد الكراسي</h4>
            <p>{{ $hall->seats }}</p>

            <h4>البوفيه</h4>
            <p>{{ $hall->has_buffet }}</p>

            <h4>وقت البدايه</h4>
            <p>{{ $hall->start_time }}</p>

            <h4>وقت النهايه</h4>
            <p>{{ $hall->end_time }}</p>
            <h4>اسم المستخدم</h4>
            @if($hall->user)
                <p>  {{ $hall->user->name }}</p>
            @else
                <span class="text-muted">لا يوجد مستخدم</span>
            @endif
            </div>

         

        <div class="buttons-container">
            <a href="{{route('hall.edit', $hall->id)}}" class="edit">تعديل</a> 
            <a href="{{ route('hall.index')}}" class="cancel">رجوع</a>
        </div>
    </div>
</main>

@endsection