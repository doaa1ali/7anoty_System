@extends('Layout.master')

@section('Show-Books')

    <div class="page-header">
        <h1>جدول المقابر</h1>
        <div class="header-actions">
            <button class="create-btn">
                <a href="{{route('cemetery.create')}}">
                    <span class="fas fa-plus"></span> إضافة مقبره جديدة
                </a>
            </button>
            <form action="{{route('cemetery.search')}}" method="GET" class="search-container">
                <input type="text" name="query" id="searchInput" placeholder="أدخل اسم المقبره...">
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
                    <th>الاسم</th>
                    <!-- <th>الوصف</th> -->
                    <th>الموقع</th>
                    <!-- <th>الإحداثيات</th> -->
                    <th>الحجم</th>
                    <th>السعر</th>
                    <th>الخصم</th>
                    <th>الصورة</th>
                    <th>مضيف المقبرة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cemeteries as $cemetery)
                    <tr>
                        <td>{{ $cemetery->id }}</td>
                        <td>{{ $cemetery->name }}</td>
                        <!-- <td>{{ $cemetery->description ?? 'لا يوجد وصف' }}</td> -->
                        <td>{{ $cemetery->location }}</td>
                        <!-- <td>{{ $cemetery->lat }}, {{ $cemetery->long }}</td> -->
                        <td>{{ $cemetery->size }} م²</td>
                        <td>{{ $cemetery->price }} $</td>
                        <td>{{ $cemetery->is_discount ? $cemetery->discount . '%' : '0 ' }}</td>
                        <td>
                            @if($cemetery->image)
                                <img src="{{ asset('uploads/cemeteryimages/' . $cemetery->image) }}" width="80" height="80" style="border-radius: 50%;">
                            @else
                            <p><img src="{{ asset('uploads/cemeteryimages/2.jpg') }}" width="80" height="80" style="border-radius: 50%;"></p>

                            @endif
                        </td>
                        <td>{{ $cemetery->user->name}}</td>

                        <td class="actions">
                            <a href="{{route('cemetery.edit', $cemetery->id)}}" class="edit-btn">تعديل</a>
                            <a href="{{route('cemetery.show', $cemetery->id)}}" class="show-btn">عرض</a>
                            <form action="{{route('cemetery.Delete', $cemetery->id)}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذه المقبره')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
