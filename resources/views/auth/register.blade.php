
<x-auth_layout word="Register">

    <div class="register-container">
        <form action="{{route('auth.handleregister')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="phone">phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location">

            <label>Profile Image:</label>
            <input type="file" name="image"><br>

             <label for="type">Type:</label>
             <select name="type" id="type">

                <option value="customer">customer</option>
                <option value="creator">creator</option>

             </select>

            <button type="submit">Register</button>

            <x-error />

            <a href="{{ route('auth.login') }}" class="login-link">Already have an account? Login</a>
        </form>
    </div>
</x-auth_layout>
