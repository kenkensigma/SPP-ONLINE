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

    {{-- dotlottie --}}
    <script type="module">
        import 'https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs';
    </script>

    {{-- Font --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    </style>

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Vue Js --}}
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

    {{-- dotlottie --}}
    <script type="module">
        import 'https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs';
    </script>

</head>

<body>
    {{-- Loading Page --}}
    <div id="loader-overlay"
        style="position:fixed; top:0; left:0; width:100%; height:100%; background:white; display:flex; justify-content:center; align-items:center; z-index:9999;">
        <dotlottie-player src="https://lottie.host/aad22b25-f8c6-4828-9933-c99c287d8917/ZN8y32ibnD.lottie"
            background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay>
        </dotlottie-player>
    </div>



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
            const container = document.querySelector('.sidebar-container');

            sidebar.classList.toggle('show');
            container.classList.toggle('sidebar-hidden');
        }



        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader-overlay').style.display = 'none';
            }, 2500);
        });
    </script>
</body>

</html>
