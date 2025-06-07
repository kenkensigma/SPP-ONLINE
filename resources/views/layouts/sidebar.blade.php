<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">


    {{-- Font --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Vue Js --}}
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

</head>

<body>
    <div class="sidebar-container">
        {{-- Sidebar --}}
        <div class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-section">
                    <img src="{{ asset('img/logo-skensa.png') }}" alt="Logo Skensa" class="logo-img">
                    <div class="logo-text">
                        <strong>Sistem Informasi</strong>
                        Perekapan Sumbangan Pembinaan Pendidikan
                    </div>
                    <button class="close-btn" onclick="toggleSidebar()">✕</button>
                </div>
            </div>


            <div class="sidebar-nav">
                <nav class="nav">
                    <a href="{{ url('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ url('user') }}" class="{{ Request::is('user') ? 'active' : '' }}">
                        <i class="fas fa-user-friends"></i>
                        <span>User</span>
                    </a>
                    <a href="{{ url('kelas') }}" class="{{ Request::is('kelas') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        <span>Kelas</span>
                    </a>
                    <a href="{{ url('informasi-siswa') }}" class="{{ Request::is('informasi-siswa') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        <span>Informasi Siswa</span>
                    </a>
                </nav>
            </div>

            <div class="sidebar-logout">
                <a href="{{ route('logout') }}" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </div>

        {{-- Main Content --}}
        <main class="main">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }
    </script>

</body>

</html>
