@extends('Layout.master')

@section('Show-Books')

    <div class="page-header">
        <h1>دار المناسبات</h1>
        <div class="header-actions">
            <button class="create-btn">
                <a href="{{route('hall.create')}}">
                    <span class="fas fa-plus"></span> إضافة قاعه جديده
                </a>
            </button>
            <form action="{{route('hall.search')}}" method="GET" class="search-container">
                <input type="text" name="query" id="searchInput" placeholder="أدخل اسم القاعه...">
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
                    <th>الوصف</th>
                    <th>الموقع</th>
                    <th>السعر</th>
                    <th>الصوره</th>
                    <th>الكراسي</th>
                    <th>خدمه البوفيه</th>
                    <th>معاد الحجز</th>
                    <th>معاد النهايه</th>
                    <th>اسم المستخدم</th>
                    <th>الاحداث</th>
                </tr>
            </thead>
            <tbody>
                @foreach($halls as $hall)
                    <tr>
                        <td>{{ $hall->id }}</td>
                        <td>{{ $hall->name }}</td>
                        <td>{{ $hall->description }}</td>
                        <td>{{ $hall->location }}</td>
                        <td>{{ $hall->price }}</td>
                        <td>
                            @if($hall->image)
                                <img src="{{ asset('uploads/hallimages/' . $hall->image) }}" width="80" height="80" style="border-radius: 50%;">
                            @else                   
                                <p><img src="{{ asset('uploads/hallimages/1.png') }}" width="80" height="80" style="border-radius: 50%;"></p>
                            @endif
                        </td>
                        <td>{{ $hall->seats }}</td>
                        <td>{{ $hall->has_buffet ? 'نعم' : 'لا' }}</td>
                        <td>{{ $hall->start_time }}</td>
                        <td>{{ $hall->end_time }}</td>
                        <td>
                            @if($hall->user)
                                {{ $hall->user->name }}
                            @else
                                <span class="text-muted">لا يوجد مستخدم</span>
                            @endif
                        <td class="actions">
                            <a href="{{route('hall.edit', $hall->id)}}" class="edit-btn">تعديل</a>
                            <a href="{{route('hall.show', $hall->id)}}" class="show-btn">عرض</a>
                            <form action="{{route('hall.Delete', $hall->id)}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد أنك تريد حذف القاعه؟')">حذف</button>
                            </form> 
                        </td>
                    
                        
                    </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
@endsection
