<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>LOGIN | SMARTCITY JOGJA</title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: url({{ asset('template') }}/candi.jpg) no-repeat;
            background-size: cover;
        }

        .login-box {
            width: 280px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black;
        }

        .login-box h1 {
            float: left;
            font-size: 40px;
            border-bottom: 6px solid black;
            margin-bottom: 50px;
            padding: 13px 0;
        }

        .textbox {
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            margin: 8px 0;
            border-bottom: 1px solid black;
        }

        .textbox i {
            width: 26px;
            float: left;
            text-align: center;
        }

        .textbox input {
            border: none;
            outline: none;
            background: none;
            color: black;
            font-size: 18px;
            width: 80%;
            float: left;
            margin: 0 10px;
        }

        .btn {
            width: 100%;
            background: none;
            border: 2px solid black;
            color: black;
            padding: 5px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }
    </style>
</head>

<body>
    <!-- Navbar atas laman-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow p-2 mb-3">
        <a class="navbar-brand" href="#"><img src="{{ asset('template') }}/tugutransparent.png" width="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('homepage') }}">Beranda</b></a>
                <a class="nav-link" href="{{ route('login') }}">Masuk</b></a>
                @if (Route::has('register')) <a class="nav-link" href="{{ route('register') }}">Registrasi</b></a> @endif
            </div>
        </div>
    </nav>
    </div>
    <br><br>
    </nav>
    <div class="login-box">
        <form method="POST" action="{{ route('login') }}" class="user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h1>Login</h1>
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-light btn-lg btn-block" name="masuk">Masuk</button>
        <!-- <input type="button" class="btn" value="Sign in"> -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
            <label class="form-check-label" for="remember">
                Remember Me
            </label>
        </div>
        </form>
        <h1 style="font-size:14px;color:black;">Belum punya akun? <a href="HalamanRegis.html">
                <font color=white>Registrasi</font>
            </a></h1>
        <hr>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--footer-->
    <div class="card-footer bg-dark shadow" style="opacity: 90%;" width="20">
        <center>
            Copyright @ 2020 | Smartcity Yogya
        </center>
    </div>
</body>

</html>
