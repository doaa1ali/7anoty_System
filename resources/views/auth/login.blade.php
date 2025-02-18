
<x-auth_layout word="Login">

    <div class="register-container">
        <form action="{{route('auth.handlelogin')}}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>

            <x-error />

            <a href="{{ route('auth.register') }}" class="login-link">if you do not  have an account? Register</a>
        </form>
    </div>
</x-auth_layout>
