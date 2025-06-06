@extends('layouts.sidebar')

@section('title', 'Tambah Siswa')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/table-add.css') }}">

    <div class="page-header">
        <h1>Tambah Siswa</h1>
    </div>

    <div class="main-main">
        <div class="form-container">
            <h3>Data Siswa</h3>

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas_id" required>
                            <option disabled selected>Pilih Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}"
                            required>
                        @error('nama')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>NIS</label>
                        <input type="number" name="nis" placeholder="Masukkan NIS" value="{{ old('nis') }}"
                            required>
                        @error('nis')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Biaya</label>
                        <input type="text" name="jenis_biaya" placeholder="Masukkan Jenis Biaya"
                            value="{{ old('jenis_biaya') }}" required>
                        @error('jenis_biaya')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-row">
                        <div class="form-group">
                            <label>Total Tagihan</label>
                            <input type="text" name="total_tagihan" placeholder="Masukkan Total Tagihan"
                                value="{{ old('total_tagihan') }}" required>
                            @error('total_tagihan')
                                <small style="color: red;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" required>
                                <option selected disabled>Status</option>
                                <option value="Lunas" {{ old('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Belum Bayar" {{ old('status') == 'Belum Bayar' ? 'selected' : '' }}>Belum
                                    Lunas
                                </option>
                            </select>
                            @error('status')
                                <small style="color: red;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Created</label>
                            <input type="date" name="created" value="{{ old('created') }}" required>
                            @error('created')
                                <small style="color: red;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn-add">Tambah Data</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
