<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة خدمة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/service/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">أضف خدمتك</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">اسم الخدمة</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">صورة الخدمة</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">وصف الخدمة</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">السعر</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">الموقع</label>
                <select name="location" id="location" class="form-select" required>
                    <option value="">اختر المحافظة</option>
                    @foreach (['القاهرة', 'الجيزة', 'الإسكندرية', 'أسوان', 'الأقصر', 'أسيوط', 'بورسعيد', 'دمياط', 'الدقهلية', 'الفيوم', 'كفر الشيخ', 'الغربية', 'المنوفية', 'الشرقية', 'قنا', 'سوهاج', 'السويس', 'بني سويف', 'مطروح', 'المنيا'] as $loc)
                        <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_discount" id="is_discount" class="form-check-input" value="1">
                <label for="is_discount" class="form-check-label">هل يوجد خصم؟</label>
            </div>

            <div class="mb-3" id="discount_field" style="display: none;">
                <label for="discount" class="form-label">قيمة الخصم</label>
                <input type="number" name="discount" id="discount" class="form-control" min="0">
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">وقت البدء</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">وقت الانتهاء</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">حفظ الخدمة</button>
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