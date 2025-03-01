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


                </div>

            <button type="submit" class="btn">اضافه</button><br><br>
        </form>
    </div>
</div>

@endsection
