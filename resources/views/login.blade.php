<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styleslogin.css') }}">

</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <!-- Logo di tengah halaman -->
            <div class="logo">
                <img src="assets/14793336.jpg" alt="Logo" class="logo-img">
            </div>
            <h2>Login</h2>

            @if ($errors->any())
    <div class="error-container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form untuk User -->
<form action="{{ route('loginProcess') }}" method="POST">
    @csrf
    <input type="hidden" name="user_type" value="user">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login as User</button>
</form>

<!-- Form untuk Admin -->
<form action="{{ route('loginProcess') }}" method="POST">
    @csrf
    <input type="hidden" name="user_type" value="admin">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login as Admin</button>
</form>


     <p class="create-account">Don't have an account?  <a href="{{ route('registerAccount') }}">Create Account</a></p>

        </div>
    </div>
</body>
</html>
