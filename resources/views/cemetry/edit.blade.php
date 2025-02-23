@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('cemetry.index') }}"><button class="close-btn">x</button></a>
        <h2>تعديل المقبرة: {{ $cemetery->name }} </h2>

        <form action="{{ route('cemetry.update', $cemetery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">اسم المقبرة:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $cemetery->name) }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="description">الوصف:</label>
                <textarea style="width: 100%;" id="description" name="description">{{ old('description', $cemetery->description) }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="location">الموقع:</label>
                <input type="text" id="location" name="location" value="{{ old('location', $cemetery->location) }}" required>
                @error('location') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="mapSearch">ابحث عن موقع:</label>
                <input type="text" id="mapSearch" placeholder="ابحث عن الموقع">
                <button type="button" onclick="searchInMap()">بحث</button>

                <div id="map-container">
                    <iframe
                        id="mapFrame"
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        src="https://www.google.com/maps?q={{ $cemetery->lat }},{{ $cemetery->long }}&z=15&output=embed">
                    </iframe>
                </div>

                <input type="hidden" id="lat" name="lat" value="{{ old('lat', $cemetery->lat) }}">
                <input type="hidden" id="long" name="long" value="{{ old('long', $cemetery->long) }}">
            </div>

            <div class="input-group">
                <label for="size">المساحة (م²):</label>
                <input type="number" id="size" name="size" value="{{ old('size', $cemetery->size) }}" required>
                @error('size') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label>صورة المقبرة الحالية:</label><br>
                @if($cemetery->image)
                    <img src="{{ asset('uploads/cemeteryimages/' . $cemetery->image) }}" width="100" height="100" style="border-radius: 10px;">
                @else
                    <p>لا توجد صورة</p>
                @endif
            </div>

            <div class="input-group">
                <label>تغيير الصورة:</label>
                <input type="file" name="image">
            </div>

            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="number" id="price" name="price" value="{{ old('price', $cemetery->price) }}" required>
                @error('price') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="is_discount">هل يوجد خصم؟</label>
                <select name="is_discount" id="is_discount">
                    <option value="1" {{ old('is_discount', $cemetery->is_discount) == '1' ? 'selected' : '' }}>نعم</option>
                    <option value="0" {{ old('is_discount', $cemetery->is_discount) == '0' ? 'selected' : '' }}>لا</option>
                </select>
            </div>

            <div class="input-group">
                <label for="discount">نسبة الخصم (%):</label>
                <input type="number" id="discount" name="discount" value="{{ old('discount', $cemetery->discount) }}" min="0" max="100">
                @error('discount') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="creator_id">منشئ المحتوى:</label>
                <select name="user_id" id="user_id" required>
                    <option value="">اختر منشئ المحتوى</option>
                    @foreach($creators as $creator)
                        <option value="{{ $creator->id }}" {{ old('user_id', $cemetery->user_id) == $creator->id ? 'selected' : '' }}>
                            {{ $creator->name }}
                        </option>
                    @endforeach
                </select>
                @error('creator_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn">حفظ التعديلات</button><br><br>
            <p>
                لم تجد منشئ المحتوى؟
                <a href="{{ route('auth.register') }}">سجّل منشئ محتوى جديد</a>
            </p>
        </form>
    </div>
</main>
@endsection
