@extends('Layout.master')

@section('Show-Books')

    <div class="page-header">
        <h1>جدول الحجوزات</h1>
        <div class="header-actions">
            <button class="create-btn">
                <a href="">
                    <span class="fas fa-plus"></span> إضافة حجز جديد
                </a>
            </button>
            <form action="{{route('auth.search')}}" method="GET" class="search-container">
                <input type="text" name="query" id="searchInput" placeholder="أدخل اسم المستخدم...">
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
                    <th>اسم المستخدم</th>
                    <th>تاريخ الحجز</th>
                    <th>الخدمة</th>
                    <th>القاعة</th>
                    <th>اسم المقبرة</th>
                    <th>السعر النهائي</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @foreach($order->bookDurations as $bookDuration)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $bookDuration->booking_date }}</td>
                            <td>{{ $bookDuration->service->name ?? 'لا يوجد' }}</td>
                            <td>{{ $bookDuration->hall->name ?? 'لا يوجد' }}</td>
                            <td>{{ $order->cemetery->name ?? 'لا يوجد' }}</td>
                            <td>{{ $order->final_price }}</td>
                            <td class="actions">
                                <a href="" class="edit-btn">تعديل</a>
                                <a href="" class="show-btn">عرض</a>
                                <form action="" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا الحجز؟')">حذف</button>
                                </form> 
                            </td>
                        </tr>
                    @endforeach
                @endforeach   
            </tbody>
        </table>
    </div>
@endsection
