@extends('Layout.master')

@section('Show-Books')

    <div class="page-header">
        <h1>جدول المستخدمين</h1>
        <div class="header-actions">
            <button class="create-btn">
                <a href="">
                    <span class="fas fa-plus"></span> إضافة مستخدم جديد
                </a>
            </button>
            <form action="" method="GET" class="search-container">
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
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>كلمة المرور</th>
                    <th>رقم الهاتف</th>
                    <th>الموقع</th>
                    <th>صورة الملف الشخصي</th>
                    <th>النوع</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>heddin</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->location }}</td>
                        <td>
                            @if($user->profile_image)
                                <img src="{{ asset('uploads/hanotyimages' . $user->image) }}" width="80" height="80" style="border-radius: 50%;">
                            @else                   
                                <p><img src="{{ asset('uploads/hanotyimages/1.png') }}" width="80" height="80" style="border-radius: 50%;"></p>
                            @endif
                        </td>
                        <td>{{ $user->type }}</td>
                        <td class="actions">
                            <a href="" class="show-btn">عرض</a>
                            <a href="" class="edit-btn">تعديل</a>
                            <form action="" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟')">حذف</button>
                            </form> 
                        </td>
                    </tr>
                @endforeach   
            </tbody>
        </table>
    </div>

@endsection
