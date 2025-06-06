@extends('layouts.sidebar')

@section('title', 'Edit User')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/user-add.css') }}">

    <div class="page-header">
        <h1>Edit User</h1>
    </div>

    <div class="form-container">
        <h3>Form Edit User</h3>

        <form action="{{ route('user.update', $petugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $petugas->nama) }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $petugas->email) }}" required>
                </div>

                <div class="form-group">
                    <label>Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password">
                </div>
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <select name="role" required>
                    <option disabled {{ old('role', $petugas->role) ? '' : 'selected' }}>Pilih Jabatan</option>
                    <option value="admin" {{ old('role', $petugas->role) == 'admin' ? 'selected' : '' }}>Petugas
                    </option>
                    <option value="wali-guru" {{ old('role', $petugas->role) == 'wali-guru' ? 'selected' : '' }}>Wali-Guru</option>
                </select>

            </div>

            <div class="btn-container">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
