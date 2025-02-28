@extends('Layout.master')

@section('Show-Books')
<main>
    <div class="register-box">
        <a href="{{ route('auth.index') }}"><button class="close-btn">x</button></a>
        <h2>تعديل بيانات المستخدم</h2>

        <form action="{{ route('auth.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="phone">رقم الهاتف:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                @error('phone') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <div class="map-container">
                    <div >
                        <label>الموقع:</label>
                        <div class="text-center">
                        <input id="location_inp" type="text" name="location" value="{{ old('location', $user->location) }}" /><br><br>
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
                <label>صورة الملف الشخصي:</label>
                <input type="file" name="image">
                @error('image') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="type">نوع الحساب:</label>
                <select name="type" id="type">
                    <option value="customer" {{ old('type', $user->type) == 'customer' ? 'selected' : '' }}>مستخدم عادي</option>
                    <option value="creator" {{ old('type', $user->type) == 'creator' ? 'selected' : '' }}>مُنشئ محتوى</option>
                </select>
                @error('type') <p class="error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn">حفظ التعديلات</button>
        </form>
    </div>
</main>
@endsection
