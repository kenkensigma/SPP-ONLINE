@extends('layouts.sidebar')

@section('title', 'User')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/user-add.css') }}">

    <div class="page-header">
        <h1>Tambah User</h1>
    </div>

    <div class="form-container">
        <h3>Data User</h3>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                    @error('email')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" value="{{ old('password') }}"
                        required>
                    @error('password')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <select name="role" required>
                    <option selected disabled>Pilih Jabatan</option>
                    <option value="admin">Admin</option>
                    <option value="wali-guru">Wali Guru</option>
                </select>
            </div>

            <div class="btn-kotak">
                <button type="submit" class="btn-primary">Tambah Data</button>
            </div>
        </form>
    </div>
@endsection
