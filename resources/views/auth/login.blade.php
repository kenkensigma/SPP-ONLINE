<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container-alert">
        @session('success')
            <div class="alert" id="success-alert">
                {{ session('succes') }}
            </div>
        @endsession

        @session('error')
            <div class="alert alert-error" id="error-alert">
                {{ session('error') }}
            </div>
        @endsession
    </div>
    <!-- Ini Logo Ngambang -->
    <div class="floating-bg">
        <img src="../img/bulet.png" class="shape float" style="top: 10%; left: 10%;" />
        <img src="../img/lonjong.png" class="shape float" style="top: 70%; left: 75%;" />
        <img src="../img/kotak.png" class="shape float" style="top: 70%; left: 5%;"/>
        <img src="../img/segitiga.png" class="shape float" style="top: 10%; left: 80%;" />
    </div>
    <!-- Ini Login Form Nya -->
    <div class="form-login">
        <img src="../img/logo-skensa.png" alt="">
        <h2>LOGIN FORM</h2>
        <form class="form" action="{{ route('login') }}" method="post">
            @csrf
            <label for="email">EMAIL</label>
            <input type="text" id="email" name="email" placeholder="Enter your email" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="text" id="password" name="password" placeholder="Enter your password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" value="Send">LOG IN</button>
        </form>
    </div>

</body>

</html>
