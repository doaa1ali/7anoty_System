@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('hall.index') }}"><button class="close-btn">x</button></a>
        <h2>تعديل دار المناسبات</h2>

        <form action="{{ route('hall.update', $hall->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $hall->name) }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>


            <div class="input-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description">{{ old('description',$hall->description) }}</textarea>
            </div>


            <div class="input-group">
                <div class="map-container">
                    <div >
                        <label>الموقع:</label>
                        <div class="text-center">
                        <input id="location_inp" type="text" name="location" value="{{ old('location', $cemetery->location) }}" /><br><br>
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

            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="text" id="price" name="price" value="{{ old('price',$hall->price) }}" required>
            </div>

            <div class="input-group">
                <label for="seats">عدد الكراسي:</label>
                <input type="number" id="seats" name="seats" value="{{ old('seats',$hall->seats) }}" required>
            </div>

            <div class="input-group">
                <label for="has_buffet">هل هناك خدمه بوفيه؟</label>
                <select id="has_buffet" name="has_buffet" value="{{ old('has_buffet',$hall->has_buffet) }}">
                    <option value="0">لا</option>
                    <option value="1">نعم</option>
                </select>
            </div>
            <div class="input-group">
                    <label for="start_time">وقت البداية:</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $hall->start_time)}}" required>
                </div>

                <div class="input-group">
                    <label for="end_time">وقت النهاية:</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time',$hall->end_time) }}" required>
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
        </form>
    </div>
</main>
@endsection
