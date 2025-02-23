@extends('Layout.master')

@section('Show-Books')
<main class="container">
    <div class="card">
        <div class="user-info">
            @if($user->image)
                <img src="{{ asset('uploads/userimages/' . $user->image) }}" class="profile-img">
            @else                   
                <img src="{{ asset('uploads/userimages/1.png') }}" class="profile-img">
            @endif
            <h3>{{ $user->name }}</h3>
            <span class="email">{{ $user->email }}</span>
        </div>

        <div class="auth-details">
            <h4>كلمة المرور</h4>
            <p class="pass">{{$user->password}}</p>

            <h4>رقم الهاتف</h4>
            <p>{{ $user->phone }}</p>
            
            <h4>الموقع</h4>
            <p>{{ $user->location }}</p>

            <h4>النوع</h4>
            <p>{{ $user->type == 'customer' ? 'مستخدم عادي' : 'منشئ محتوى' }}</p>
        </div>

        <div class="buttons-container">
            <a href="{{route('auth.edit', $user->id)}}" class="edit">تعديل</a> 
            <a href="{{ route('auth.index')}}" class="cancel">رجوع</a>
        </div>
    </div>
</main>

@endsection
