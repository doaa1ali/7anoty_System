<header>
    <div class="menu-toggle">
        <img src="{{ asset('uploads/ImageWebsite/Logo.png') }}" alt="logo" class="logo">
        <label class="header-title">الحانوتي</label>
    </div>

   <div class="navbar">
        <nav class="header-nav">
            <a href="{{route('home')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
            <a href="{{route('service')}}" class="{{ request()->routeIs('service') ? 'active' : '' }}">خدماتنا</a>
            <a href="{{route('prayers')}}" class="{{ request()->routeIs('prayers') ? 'active' : '' }}">أدعية وأذكار</a>
            <a href="#" class="{{ request()->routeIs('about') ? 'active' : '' }}">من نحن</a>
            <a href="#" class="{{ request()->routeIs('contact') ? 'active' : '' }}">تواصل معنا</a>
        </nav>
    </div>

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
        <p style="color:#cfc1c1">مرحبا {{Auth::user()->name }}  ({{Auth::user()->type }})😊</p>
        <a href="{{ route('auth.logout') }}" class="logout-btn">
            <span class="fas fa-sign-out-alt"></span> تسجيل الخروج
        </a>
    </div>
    @endauth

</header>
