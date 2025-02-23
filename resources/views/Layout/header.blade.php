<header>
    <div class="menu-toggle">
        <label><span class="fas fa-bars"></span></label>
        <label class="header-title">
            <a href="{{route('home')}}">الحانوتي</a>
        </label>
        

    </div>

    <div class="header-right">

    @guest
    <div class="header-account">
        <a href="{{ route('auth.login') }}" class="login-btn">
            <span class="fas fa-sign-in-alt"></span> تسجيل الدخول
        </a>
        <a href="{{ route('auth.register') }}" class="register-btn" id="open-register">
            <span class="fas fa-user-plus"></span> إنشاء حساب
        </a>
    </div>
    @endguest

    @auth
    <div class="header-account">
        <a href="{{ route('auth.logout') }}" class="logout-btn">
            <span class="fas fa-sign-out-alt"></span> تسجيل الخروج
        </a>
    </div>
    @endauth

    </div>

</header>



