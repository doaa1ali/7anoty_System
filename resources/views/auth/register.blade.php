
<x-auth_layout word="التسجيل">

<div class="register-container">
    <div class="register-box">

        <a href="/"><button class="close-btn" >x</button></a>
        <h2>إنشاء حساب</h2>
        <form action="{{ route('auth.handleregister') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="password">كلمة المرور:</label>
                <input type="password" id="password" name="password" required>
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>



            <div class="input-group">
                <label for="phone">رقم الهاتف:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone') <p class="error">{{ $message }}</p> @enderror
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
                <label>صورة الملف الشخصي:</label>
                <input type="file" name="image">
            </div>

            <div class="input-group">
                <label for="type">نوع الحساب:</label>
                <select name="type" id="type">
                    <option value="customer" {{ old('type') == 'customer' ? 'selected' : '' }}>مستخدم عادي</option>
                    <option value="creator" {{ old('type') == 'creator' ? 'selected' : '' }}>مُنشئ محتوى</option>
                </select>
            </div>

            <button type="submit" class="btn">تسجيل</button><br><br>
            <a>هل لديك حساب؟ <a href="{{ route('auth.login') }}">تسجيل الدخول</a>
        </form>
    </div>
</div>

</x-auth_layout>
