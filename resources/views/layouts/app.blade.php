
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ASSB Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 60px;
            transition: left 0.3s ease;
        }
        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar.show {
            left: 0;
        }
        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .content.shifted {
            margin-left: 250px;
        }
        .hamburger {
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Hamburger Menu -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 hamburger" onclick="toggleSidebar()">☰</span>
        <span class="text-white">ASSB Management</span>
    </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>

    @php
    use Illuminate\Support\Facades\Auth;
    $role = Auth::check() ? Auth::user()->role : '';
@endphp

@if($role === 'admin')
    <a href="{{ route('records.aics') }}">📁 AICS Records</a>
    <a href="{{ route('records.senior') }}">👴 Senior Citizen Records</a>
    <a href="{{ route('records.solo') }}">👩‍👧 Solo Parent Records</a>
    <a href="{{ route('records.pwd') }}">♿ PWD Records</a>
    <a href="{{ route('records.all') }}">📋 All Records</a>
@elseif($role === 'aics')
    <a href="{{ route('records.aics') }}">📁 Record List</a>
@elseif($role === 'senior')
    <a href="{{ route('records.senior') }}">📁 Record List</a>
@elseif($role === 'solo')
    <a href="{{ route('records.solo') }}">📁 Record List</a>
@elseif($role === 'pwd')
    <a href="{{ route('records.pwd') }}">📁 Record List</a>
@endif


    <a href="{{ route('logout') }}">🚪 Logout</a>
</div>







<!-- Main Content -->
<div id="main-content" class="content">
    @yield('content')
</div>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("show");
        document.getElementById("main-content").classList.toggle("shifted");
    }
</script>

</body>
</html>
