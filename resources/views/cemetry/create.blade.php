
@extends('Layout.master')

@section('Show-Books')
 <main>

        <div class="register-box">

            <a href="{{route('cemetry.index')}}"><button class="close-btn" >x</button></a>
            <h2>إضافة مقبره جديدة </h2>
            <form action="{{ route('cemetry.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="input-group">
                    <label for="name">اسم المقبرة:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="description">الوصف:</label>
                    <textarea style="width: 100%;" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="location">الموقع:</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" required>
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
                        src="https://www.google.com/maps?q=30.0444,31.2357&z=15&output=embed">
                    </iframe>
                </div>

                <input type="hidden" id="lat" name="lat">
                <input type="hidden" id="long" name="long">
            </div>

                <div class="input-group">
                    <label for="size">المساحة (م²):</label>
                    <input type="number" id="size" name="size" value="{{ old('size') }}" required>
                    @error('size') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label>صورة المقبرة:</label>
                    <input type="file" name="image">
                </div>

                <div class="input-group">
                    <label for="price">السعر:</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required>
                    @error('price') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="is_discount">هل يوجد خصم؟</label>
                    <select name="is_discount" id="is_discount">
                        <option value="1" {{ old('is_discount') == '1' ? 'selected' : '' }}>نعم</option>
                        <option value="0" {{ old('is_discount') == '0' ? 'selected' : '' }}>لا</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="discount">نسبة الخصم (%):</label>
                    <input type="number" id="discount" name="discount" value="{{ old('discount') }}" min="0" max="100">
                    @error('discount') <p class="error">{{ $message }}</p> @enderror
                </div>

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
                    @error('creator_id') <p class="error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn">حفظ</button><br><br>
                <p>
                    لم تجد منشئ المحتوي؟
                    <a href="{{ route('auth.register') }}">سجّل منشئ محتوي جديد</a>
                </p>
            </form>
        </div>
</main>
@endsection
