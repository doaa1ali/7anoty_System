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
                <div class="map-container">
                    <div >
                        <label>الموقع:</label>
                        <div class="text-center">
                        <input id="location_inp" type="text" name="location" placeholder="ابحث عن الموقع..." /><br><br>
                            <div id="googleMap"
                                style="width: 100%;min-height:300px;border:1px solid #009EF7; border-radius: 10px; ">
                            </div>
                            <input type="hidden" id="lat_inp" name="lat">
                            <input type="hidden" id="lng_inp" name="long">
                            <p class="invalid-feedback" id="lat"></p>
                        </div>
                    </div>
                </div>
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

            @if (auth()->check() && auth()->user()->type != 'creator')
                <div class="input-group">
                    <label for="creator_id">منشئ المحتوي:</label>

                    <select name="user_id" id="user_id" required>
                        <option value="">اختر منشئ المحتوي</option>
                        @foreach($creators as $creator)
                            <option value="{{ $creator->id }}" {{ old('user_id') == $creator->id ? 'selected' : '' }}>
                                {{ $creator->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                @endif

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
