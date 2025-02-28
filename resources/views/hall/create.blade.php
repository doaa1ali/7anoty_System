@extends('Layout.master')

@section('Show-Books')

<div class="container">
    <div class="register-box">

    <a href="{{route('hall.index')}}"><button class="close-btn" >x</button></a>
        <h2> اضافه دار مناسبات</h2>
        <form action="{{ route('hall.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="input-group">
                <label for="location">الموقع:</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}">
            </div>

           <!--  -->
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
            <!--  -->
            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}">
            </div>

            <div class="input-group">
                <label for="seats">عدد الكراسي:</label>
                <input type="number" id="seats" name="seats" value="{{ old('seats') }}">
            </div>

            <div class="input-group">
                <label for="has_buffet">هل هناك خدمه بوفيه؟</label>
                <select id="has_buffet" name="has_buffet">
                    <option value="0">لا</option>
                    <option value="1">نعم</option>
                </select>
            </div>



               <div class="input-group">
                    <label for="start_time">وقت البداية:</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                </div>

                <div class="input-group">
                    <label for="end_time">وقت النهاية:</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                </div>

                <div class="input-group">
                <label for="image">اضافه صورة :</label>
                <input type="file" id="image" name="image">
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

                @error('creator_id') <p class="error">{{ $message }}</p> @enderror


                <button type="submit" class="btn">حفظ</button><br><br>
                @if (auth()->check() && auth()->user()->type != 'creator')

                    <p>
                        لم تجد منشئ المحتوي؟
                        <a href="{{ route('auth.create') }}">سجّل منشئ محتوي جديد</a>
                    </p>
                @endif


            <!-- <button type="submit" class="btn">اضافه</button><br><br> -->
        </form>
    </div>
</div>

@endsection
