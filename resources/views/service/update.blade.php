<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث الخدمة</title>
    <link href="/css/service/update.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">تحديث الخدمة</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">اسم الخدمة</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">صورة الخدمة</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="صورة الخدمة" class="img-fluid mt-2" style="max-width: 100px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">وصف الخدمة</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">السعر</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $service->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">الموقع</label>
                <select name="location" id="location" class="form-select" required>
                    <option value="">اختر المحافظة</option>
                    @foreach (['القاهرة', 'الجيزة', 'الإسكندرية', 'أسوان', 'الأقصر', 'أسيوط', 'بورسعيد', 'دمياط', 'الدقهلية', 'الفيوم', 'كفر الشيخ', 'الغربية', 'المنوفية', 'الشرقية', 'قنا', 'سوهاج', 'السويس', 'بني سويف', 'مطروح', 'المنيا'] as $loc)
                        <option value="{{ $loc }}" {{ old('location', $service->location) == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_discount" id="is_discount" class="form-check-input" value="1" {{ old('is_discount', $service->is_discount) ? 'checked' : '' }}>
                <label for="is_discount" class="form-check-label">هل يوجد خصم؟</label>
            </div>

            <div class="mb-3" id="discount_field" style="display: {{ old('is_discount', $service->is_discount) ? 'block' : 'none' }};">
                <label for="discount" class="form-label">قيمة الخصم</label>
                <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', $service->discount) }}" min="0">
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">وقت البدء</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $service->start_time) }}" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">وقت الانتهاء</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', $service->end_time) }}" required>
            </div>

            <button type="submit" class="btn btn-warning">تحديث الخدمة</button>
        </form>
    </div>

    <script>
        document.getElementById('is_discount').addEventListener('change', function() {
            const discountField = document.getElementById('discount_field');
            if (this.checked) {
                discountField.style.display = 'block';
            } else {
                discountField.style.display = 'none';
                document.getElementById('discount').value = '';
            }
        });
    </script>
</body>
</html>