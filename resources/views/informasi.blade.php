@extends('layouts.sidebar')
@section('title', 'Informasi Siswa')

@section('content')
    <div class="page-header">
        <h1>Informasi Siswa</h1>
    </div>

    <div class="main-main">
        <input type="text" id="search-input" placeholder="Cari nama/NIS siswa...">
        <button onclick="loadSiswa()">Cari</button>

        <div class="container">
            <select id="kelas-select">
                <option disabled selected hidden>Pilih Kelas</option>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div id="siswa-container">
            <p style="text-align: center;">Silakan pilih kelas terlebih dahulu</p>
        </div>
    </div>

    <script>
        function loadSiswa() {
            const kelas = document.getElementById('kelas-select').value;
            const search = document.getElementById('search-input').value;

            if (!kelas) {
                document.getElementById('siswa-container').innerHTML = "<p style='text-align:center; color:red;'>Pilih kelas dulu!</p>";
                return;
            }

            fetch(`/informasi/fetch?kelas=${encodeURIComponent(kelas)}&search=${encodeURIComponent(search)}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('siswa-container').innerHTML = data.html;
                }).catch(() => {
                    document.getElementById('siswa-container').innerHTML = "<p style='text-align:center;'>Gagal memuat data</p>";
                });
        }

        document.getElementById('kelas-select').addEventListener('change', loadSiswa);
    </script>
@endsection
