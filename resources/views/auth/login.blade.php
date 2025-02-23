
<x-auth_layout word="التسجيل">

    <div class="register-container">
        <div class="register-box">

            <a href="/"><button class="close-btn" >x</button></a>
            <h2>تسجيل الدخول</h2>
            <form action="{{route('auth.handlelogin')}}" method="post" enctype="multipart/form-data">
                @csrf

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

                <button type="submit" class="btn">تسجيل الدخول</button><br>

                <p>ليس لديك حساب؟ <a href="{{ route('auth.register') }}">إنشاء حساب</a></p>

            </form>
        </div>
    </div>
</x-auth_layout>
