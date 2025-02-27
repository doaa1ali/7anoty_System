
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
                    <input type="text" id="name" name="name" value="{{ old('name') }}" >
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="input-group">
                    <label for="description">الوصف:</label>
                    <textarea style="width: 100%;" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description') <p class="error">{{ $message }}</p> @enderror
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
                        
                        <!-- <input type="text" id="creator_id" name="creator" value="{{ old('$creator->name') }}"> -->
                        
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
