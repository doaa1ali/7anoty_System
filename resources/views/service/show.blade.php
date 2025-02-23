<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الخدمة</title>
    <link href="stylesheet" rel="/css/">
    <link rel="stylesheet" href="/css/service/show.css">
</head>
<body>
    <div class="container mt-5">
        <h1>تفاصيل الخدمة</h1>

        <div class="card">
            <div class="card-body">
                @if ($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="صورة الخدمة" class="img-fluid mb-3">
                @endif

                <h5 class="card-title">{{ $service->name }}</h5>
                <p class="card-text">{{ $service->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>السعر:</strong> {{ $service->price }} جنيه</li>
                    <li class="list-group-item"><strong>الموقع:</strong> {{ $service->location }}</li>
                    <li class="list-group-item"><strong>يوجد خصم؟:</strong> {{ $service->is_discount ? 'نعم' : 'لا' }}</li>
                    @if ($service->is_discount)
                        <li class="list-group-item"><strong>قيمة الخصم:</strong> {{ $service->discount }} جنيه</li>
                    @endif
                    <li class="list-group-item"><strong>وقت البدء:</strong> {{ $service->start_time }}</li>
                    <li class="list-group-item"><strong>وقت الانتهاء:</strong> {{ $service->end_time }}</li>
                </ul>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning">تعديل</a>
            <a href="{{ route('service.index') }}" class="btn btn-secondary">العودة</a>
        </div>
    </div>
</body>
</html>