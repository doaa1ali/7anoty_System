
@extends('Layout.master')

@section('Show-Books')

    <div class="page-header">
        <h1>جدول الخدمات</h1>
        <div class="header-actions">
            <button class="create-btn">
                <a href="{{route('service.create')}}">
                    <span class="fas fa-plus"></span> إضافة خدمة جديد
                </a>
            </button>
            <form action="{{route('service.search')}}" method="GET" class="search-container">
                <input type="text" name="query" id="searchInput" placeholder="أدخل اسم الخدمة...">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>    
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>اسم الخدمة</th>
                    <th>الوصف</th>
                    <th>الصورة</th>
                    <th>السعر</th>
                    <th>الموقع</th>
                    <th>يوجد خصم؟</th>
                    <th>قيمة الخصم</th>
                    <th>وقت البدء</th>
                    <th>وقت الانتهاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>
                            @if ($service->image)
                            <img src="{{ asset('uploads/servicesimage/' . $service->image) }}" width="80" height="80" style="border-radius: 50%;">
                            @else                   
                            <img src="{{ asset('uploads/servicesimage/services.jpg') }}" width="80" height="80" style="border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $service->price }} جنيه</td>
                        <td>{{ $service->location }}</td>
                        <td>{{ $service->is_discount ? 'نعم' : 'لا' }}</td>
                        <td>{{ $service->discount ?? '-' }}</td>
                        <td>{{ $service->start_time }}</td>
                        <td>{{ $service->end_time }}</td>
                        <td class="actions">
                            <a href="{{route('service.show', $service->id)}}" class="show-btn">عرض</a>
                            <a href="{{ route('service.edit', $service->id) }}" class="edit-btn">تعديل</a>
                            <form action="{{route('service.delete', $service->id)}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد من حذف هذه الخدمة؟')">حذف</button>
                            </form>
                        </td>
                    
                    </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
@endsection






































{{--<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الخدمات</title>
    <link rel="stylesheet" href="/css/service/index.css">
</head>
<body>
    <div class="container mt-5">
        <h1>قائمة الخدمات</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('service.create') }}" class="btn btn-primary mb-3">إضافة خدمة جديدة</a>

        @if ($services->isEmpty())
            <p>لا توجد خدمات حالياً.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>اسم الخدمة</th>
                        <th>الوصف</th>
                        <th>السعر</th>
                        <th>الموقع</th>
                        <th>يوجد خصم؟</th>
                        <th>قيمة الخصم</th>
                        <th>وقت البدء</th>
                        <th>وقت الانتهاء</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="صورة الخدمة" style="max-width: 100px; height: auto;">
                                @else
                                    لا توجد صورة
                                @endif
                            </td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{{ $service->price }} جنيه</td>
                            <td>{{ $service->location }}</td>
                            <td>{{ $service->is_discount ? 'نعم' : 'لا' }}</td>
                            <td>{{ $service->discount ?? '-' }}</td>
                            <td>{{ $service->start_time }}</td>
                            <td>{{ $service->end_time }}</td>
                            <td>
                                <a href="{{ route('service.show', $service->id) }}" class="btn btn-info">عرض</a>
                                <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning">تعديل</a>
                                <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه الخدمة؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
    --}}