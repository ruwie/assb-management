<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PWD Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #2c2c2c;
            color: white;
            position: fixed;
            top: 0;
            left: -250px;
            transition: left 0.3s ease;
            padding-top: 60px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #444;
        }

        .main-content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .topbar {
            background-color: #0d47a1;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .show-sidebar {
            left: 0;
        }

        .content-shift {
            margin-left: 250px;
        }

        .menu-btn {
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="topbar">
    <span class="menu-btn" onclick="toggleSidebar()">☰</span>
    <h5 class="m-0">ASSB Management System - Person with Disability</h5>
</div>

<div id="sidebar" class="sidebar text-center">
    <img src="{{ asset('images/user-default.png') }}" alt="User Image" class="rounded-circle mt-2" width="80" height="80">
    <h6 class="mt-2 mb-0 text-white">{{ Auth::user()->name ?? 'pwd Name' }}</h6>
    <small class="text-white-50">Person with Disability</small>
    <a href="{{ url('/pwd/dashboard') }}">🏠 Dashboard</a>
    <a href="{{ url('/pwd/records') }}">📋 Personal with Disability Records</a>
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger ms-3 mt-2">Logout</button>
    </form>
</div>

<div id="main" class="main-content">
    @yield('content')
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main');
        sidebar.classList.toggle('show-sidebar');
        main.classList.toggle('content-shift');
    }
</script>

</body>
</html>
