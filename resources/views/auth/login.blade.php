<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <title>Login</title>
</head>
<body>
    <section class="login">
        <form method="POST" class="login-form" action="{{route('login.store')}}">
            @csrf
            <label class="login-form-label" for="username">Username:</label>
            <input class="login-form-input" type="text" name="email">
            <label class="login-form-label" for="password">Password:</label>
            <input class="login-form-input" type="password" name="password">
            <div class="login-form-remember">
                <label class="login-form-label" for="remember">Remember Me?</label>
                <input class="login-form-check" type="checkbox" name="remember">
            </div>
            <input class="login-form-button" type="submit">

            @include('admin.errors')

        </form>
    </section>
</body>
</html>