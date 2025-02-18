<header>
    <div class="menu-toggle">

        <label><span class="fas fa-bars"></span></label>
        <label class="header-title">Library System</label>

    </div>

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
    <a href="{{ route('auth.logout') }}" class="logout-btn">
    <span class="fas fa-sign-out-alt"></span> Logout
     </a>
    </div>
    @endauth

    </div>

</header>



