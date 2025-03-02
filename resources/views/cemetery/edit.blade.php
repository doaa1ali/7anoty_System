@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('cemetery.index') }}"><button class="close-btn">x</button></a>
        <h2>تعديل المقبرة: {{ $cemetery->name }} </h2>

        <form action="{{ route('cemetery.update', $cemetery->id) }}" method="POST" enctype="multipart/form-data">
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
                <label for="size">المساحة (م²):</label>
                <input type="number" id="size" name="size" value="{{ old('size', $cemetery->size) }}" required>
                @error('size') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label>صورة المقبرة الحالية:</label><br>
                @if($cemetery->image)
                    <img src="{{ asset('uploads/cemeteryimages/' . $cemetery->image) }}" width="100" height="100" style="border-radius: 50%;">
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
