@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('hall.index') }}"><button class="close-btn">x</button></a>
        <h2>تعديل بيانات المستخدم</h2>

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
                <label for="location">الموقع:</label>
                <input type="text" id="location" name="location" value="{{ old('location',$hall->location) }}" required>
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

           

            <button type="submit" class="btn">حفظ التعديلات</button>
        </form>
    </div>
</main>
@endsection
