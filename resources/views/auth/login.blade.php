<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta charset="UTF-8">
    <title>Login | ASSB Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/images/login-bg.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .login-box {
            background: rgba(255,255,255,0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
    <a class="navbar-brand" href="#">ASSB Management System</a>
    <div class="navbar-nav">
        <a class="nav-link" href="#">Home</a>
        <a class="nav-link" href="#">About</a>
        <a class="nav-link" href="#">Map</a>
    </div>
</nav>
        @if ($errors->any())
    <div class="alert alert-danger mt-2">
    {{ $errors->first() }}
</div>
@endif

<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
    <div class="login-box text-center col-md-4">
        <img src="/images/mswd-logo.png" width="80" alt="MSWD Logo">
        <h4 class="mt-3 mb-4">MSWD Abucay</h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>

            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Sign in</button>
        </form>
    </div>
</div>
</body>
</html>
