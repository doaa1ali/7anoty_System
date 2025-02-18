<header>
    <label class="header-title">☠ Welcome in 7anoty System</label>
    <div class="header-right">

    @guest
    <a href="{{ route('auth.login') }}" class="login-btn">
                <span class="fas fa-sign-in-alt"></span> Login
            </a>
            <a href="{{ route('auth.register') }}" class="register-btn">
                <span class="fas fa-user-plus"></span> Register
            </a>
    @endguest

    @auth
    <div class="header-right">
    <p style="color: #cfc1c1;">Welcome ya  {{Auth::user()->name }} ({{Auth::user()->type }}) 😊!</p>
    <a href="{{ route('auth.logout') }}" class="logout-btn">
    <span class="fas fa-sign-out-alt"></span> Logout
     </a>
    </div>
    @endauth

    </div>

</header>



