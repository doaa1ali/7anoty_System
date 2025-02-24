@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('service.index') }}"><button class="close-btn">x</button></a>
        <h2>إضافة خدمة جديدة</h2>
        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label for="name">اسم الخدمة:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label>صورة الخدمة:</label>
                <input type="file" name="image">
                @error('image') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="description">وصف الخدمة:</label>
                <textarea name="description" id="description" required>{{ old('description') }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" required>
                @error('price') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="input-group">
                <label for="location">الموقع:</label>
                <select id="location" name="location" required>
                    <option value="">اختر المحافظة</option>
                        @foreach ([
                            'القاهرة', 'الجيزة', 'الإسكندرية', 'أسوان', 'الأقصر', 'أسيوط', 'بورسعيد', 'دمياط', 'الدقهلية', 
                            'الفيوم', 'كفر الشيخ', 'الغربية', 'المنوفية', 'الشرقية', 'قنا', 'سوهاج', 'السويس', 'بني سويف', 
                            'مطروح', 'المنيا', 'الوادي الجديد', 'البحيرة', 'الإسماعيلية', 'شمال سيناء', 'جنوب سيناء', 'البحر الأحمر'
                        ] as $loc)
                            <option value="{{ $loc }}" {{ old('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endforeach
                </select>
                @error('location') <p class="error">{{ $message }}</p> @enderror
            </div>


            <div class="input-group_checked">
                <input type="checkbox" name="is_discount" id="is_discount" value="1" {{ old('is_discount') ? 'checked' : '' }}>
                <label for="is_discount">هل يوجد خصم؟</label>
            </div>

            <div class="input-group" id="discount_field" style="display: none;">
                <label for="discount">قيمة الخصم:</label>
                <input type="number" name="discount" id="discount" min="0" value="{{ old('discount') }}">
                @error('discount') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="start_time">وقت البدء:</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @error('start_time') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="end_time">وقت الانتهاء:</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @error('end_time') <p class="error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn">حفظ الخدمة</button>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDiscount = document.getElementById('is_discount');
        const discountField = document.getElementById('discount_field');
        if (isDiscount.checked) {
            discountField.style.display = 'block';
        }

        isDiscount.addEventListener('change', function() {
            discountField.style.display = this.checked ? 'block' : 'none';
            if (!this.checked) document.getElementById('discount').value = '';
        });
    });
</script>
@endsection
