<!DOCTYPE html>
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