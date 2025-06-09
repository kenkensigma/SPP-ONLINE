@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.sidebar')

@section('title', '')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Succes!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        @endif
    </script>

    <link rel="stylesheet" href="{{ asset('css/kelas.css') }}">

    <div class="page-header">
        <button class="burger-btn" onclick="toggleSidebar()">☰</button>
        <h1>Kelas</h1>
    </div>

    <div class="main-main">

        <div id="search-container">
        <input type="text" id="search-input" placeholder="Cari nama/NIS siswa...">
        <button onclick="loadKelas(document.getElementById('kelas-select').value)">Cari</button>
        

        {{-- Admin bisa tambah data --}}
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('kelas.create') }}" class="btn-kelas">Tambah Data</a>
        @endif

        {{-- Export data --}}
        <a href="#" id="export-btn" oncli class="btn btn-success" style="margin-bottom: 10px;">
            Export ke Excel
        </a>
</div>
        <select id="status-filter">
            <option value="" disabled selected>Semua Status</option>
            <option value="Lunas">Lunas</option>
            <option value="Belum Bayar">Belum Bayar</option>
        </select>

        <div class="container">
            <select class="kelas-dropdown" id="kelas-select" name="kelas" required>
                <option value="" disabled selected hidden>Kelas</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI RPL 3">XI RPL 3</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
            </select>
        </div>

        <div class="container" id="tagihan-container">
            {{-- Teks defaultnya sblm milih kelas --}}
            <p style="text-align: center; color: #666;">Silahkan memilih kelas yang ingin ditampilkan.</p>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Event pas dropdown kelas keganti
        $('#kelas-select').on('change', function() {
            var kelas = $(this).val();

            if (kelas) {
                $.ajax({
                    url: `/kelas/${encodeURIComponent(kelas)}`,
                    type: 'GET',
                    success: function(res) {
                        $('#tagihan-container').html(res.html);
                    },
                    error: function() {
                        $('#tagihan-container').html(
                            '<p style="text-align:center;">Gagal memuat data tagihan.</p>');
                    }
                });
            }
        });
    </script>

    <script>
        document.getElementById('kelas-select').addEventListener('change', function() {
            const selectedKelas = this.value;
            const exportBtn = document.getElementById('export-btn');

            exportBtn.href = `/kelas/export/${encodeURIComponent(selectedKelas)}`;
        });

        document.getElementById('kelas-select').dispatchEvent(new Event('change'));
    </script>

    <script>
        document.getElementById('status-filter').addEventListener('change', function() {
            const selectedKelas = document.getElementById('kelas-select').value;
            loadKelas(selectedKelas);
        });



        function loadKelas(namaKelas) {
            if (!namaKelas) {
                document.getElementById('tagihan-container').innerHTML =
                    '<p style="text-align:center; color:red;">Silakan pilih kelas dulu!</p>';
                return;
            }

            let search = document.getElementById('search-input').value;
            let status = document.getElementById('status-filter')?.value || '';

            fetch(`/kelas/${namaKelas}?search=${search}&status=${status}`) // ← FIX DI SINI
                .then(response => response.json())
                .then(data => {
                    document.getElementById('tagihan-container').innerHTML = data.html;
                })
                .catch(error => {
                    document.getElementById('tagihan-container').innerHTML =
                        '<p style="text-align:center;">Terjadi kesalahan saat memuat data.</p>';
                });
        }
    </script>


@endsection
