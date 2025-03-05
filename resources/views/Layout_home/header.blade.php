<header>
    <div class="menu-toggle">
        <img src="{{ asset('uploads/ImageWebsite/Logo.png') }}" alt="logo" class="logo">
        <label class="header-title">الحانوتي</label>
    </div>

   <div class="navbar">
        <nav class="header-nav">
            <a href="{{route('home')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
            <a href="{{route('service')}}" class="{{ request()->routeIs('service') ? 'active' : '' }}">خدماتنا</a>
            <a href="{{route('cemetery')}}" class="{{ request()->routeIs('cemetery') ? 'active' : '' }}">المقابر</a>
            <a href="{{route('hall')}}" class="{{ request()->routeIs('hall') ? 'active' : '' }}">دار المناسبات</a>
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
        @if(Auth::user()->type === 'creator')
            <div class="header-account">
                <p style="color:#cfc1c1">مرحبا {{ Auth::user()->name }} 😊</p>
                <button class="create-btn">
                    <a href="{{ route('home.Database') }}">
                        <span class="fas fa-plus"></span> إضافة خدمة
                    </a>
                </button>
                <a href="{{ route('auth.logout') }}" class="logout-btn">
                    <span class="fas fa-sign-out-alt"></span> تسجيل الخروج
                </a>
            </div>
        @elseif(Auth::user()->type === 'admin')
            <div class="header-account">
                <p style="color:#cfc1c1">مرحبا {{ Auth::user()->name }} 😊</p>
                <button class="create-btn">
                    <a href="{{ route('home.Database') }}">
                    <span class="fas fa-database"> </span> لوحة التحكم 
                    </a>
                </button>
                <a href="{{ route('auth.logout') }}" class="logout-btn">
                    <span class="fas fa-sign-out-alt"></span> تسجيل الخروج
                </a>
            </div>
        @else
            <div class="header-account">
                <p style="color:#cfc1c1">مرحبا {{ Auth::user()->name }} 😊</p>

                <a href="{{ route('cart.view') }}" class="btn btn-primary">
                    🛒 السلة (<span id="cartCount">0</span>)
                </a>

                <script>
                    function addToCart(item) {
                    let cart = JSON.parse(localStorage.getItem("cart")) || [];
                    cart.push(item);
                    localStorage.setItem("cart", JSON.stringify(cart));

                    updateCartCount(); 
                    }

                    function updateCartCount() {
                        let cart = JSON.parse(localStorage.getItem("cart")) || [];
                        let cartCountElement = document.getElementById("cartCount");

                        if (cartCountElement) {
                            cartCountElement.innerText = cart.length;
                        }
                    }

                   
                    document.addEventListener("DOMContentLoaded", updateCartCount);

                </script>

                <a href="{{ route('auth.logout') }}" class="logout-btn">
                    <span class="fas fa-sign-out-alt"></span> تسجيل الخروج
                </a>
            </div>
        @endif
    @endauth




</header>
