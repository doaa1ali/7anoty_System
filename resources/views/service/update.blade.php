@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('service.index') }}"><button class="close-btn">x</button></a>
        <h2>تحديث الخدمة</h2>

        <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">اسم الخدمة:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label>صورة الخدمة:</label>
                <input type="file" name="image">
                @if ($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" class="preview-img">
                @endif
                @error('image') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="description">وصف الخدمة:</label>
                <textarea name="description" id="description" required>{{ old('description', $service->description) }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" required>
                @error('price') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="location">الموقع:</label>
                <select name="location" id="location" required>
                    <option value="">اختر المحافظة</option>
                    @foreach (['القاهرة', 'الجيزة', 'الإسكندرية', 'أسوان', 'الأقصر', 'أسيوط', 'بورسعيد', 'دمياط', 'الدقهلية', 'الفيوم', 'كفر الشيخ', 'الغربية', 'المنوفية', 'الشرقية', 'قنا', 'سوهاج', 'السويس', 'بني سويف', 'مطروح', 'المنيا'] as $loc)
                        <option value="{{ $loc }}" {{ old('location', $service->location) == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                    @endforeach
                </select>
                @error('location') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group_checked">
                <input type="checkbox" name="is_discount" id="is_discount" value="1" {{ old('is_discount', $service->is_discount) ? 'checked' : '' }}>
                <label for="is_discount">هل يوجد خصم؟</label>
            </div>

            <div class="input-group" id="discount_field" style="display: {{ old('is_discount', $service->is_discount) ? 'block' : 'none' }};">
                <label for="discount">قيمة الخصم:</label>
                <input type="number" name="discount" id="discount" value="{{ old('discount', $service->discount) }}" min="0">
                @error('discount') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="start_time">وقت البدء:</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $service->start_time) }}" >
                @error('start_time') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="end_time">وقت الانتهاء:</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $service->end_time) }}" 
                @error('end_time') <p class="error">{{ $message }}</p> @enderror
            </div><br><br>

            <button type="submit" class="btn">حفظ التعديلات</button>
        </form>
    </div>
</main>

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
@endsection
