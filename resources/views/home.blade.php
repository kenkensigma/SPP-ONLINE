@extends('layouts.sidebar')

@section('title', 'Beranda')

@section('content')
    <div class="page-header">
        <button class="burger-btn" onclick="toggleSidebar()">☰</button>
        <h1>Beranda</h1>
    </div>

    <main class="main-main">

        <div class="welcome-box">
            <h2 class="welcome-title">👋 Hai, {{ ucfirst(Auth::guard('web')->user()->nama) }}</h2>
            <p class="welcome-text">Senang bertemu lagi denganmu. Semoga harimu produktif!</p>
        </div>

        <div class="cards">
            <div class="card red">
                <strong>Total Alert</strong>
                <div class="card-content">
                    <i class="fa-solid fa-bell"></i>
                    <div class="text">
                        <p>100</p>
                    </div>
                </div>
            </div>
            <div class="card blue">
                <strong>Total Alert</strong>
                <div class="card-content">
                    <i class="fa-solid fa-bell"></i>
                    <div class="text">
                        <p>100</p>
                    </div>
                </div>
            </div>
            <div class="card red">
                <strong>Total Alert</strong>
                <div class="card-content">
                    <i class="fa-solid fa-bell"></i>
                    <div class="text">
                        <p>100</p>
                    </div>
                </div>
            </div>
            <div class="card blue">
                <strong>Total Pembayaran Bulanan</strong>
                <div class="card-content">
                    <i class="fa-solid fa-bell"></i>
                    <div class="text">
                        <p>{{ number_format($totalPembayaran, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
