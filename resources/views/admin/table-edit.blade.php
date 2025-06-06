@extends('layouts.sidebar')

@section('title', 'Edit Siswa')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/table-edit.css') }}">

    <div class="page-header">
        <h1>Edit Siswa</h1>
    </div>

    <div class="form-container">
        <h3>Data Siswa</h3>

        <form action="{{ route('kelas.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group"><select name="kelas_id" required>
                        <option disabled selected>Pilih Kelas</option>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id }}"
                                {{ old('kelas_id', $siswa->kelas_id) == $kls->id ? 'selected' : '' }}>
                                {{ $kls->nama_kelas }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama" value="{{ old('nama', $siswa->nama) }}"
                        required>
                </div>

                <div class="form-group">
                    <label>NIS</label>
                    <input type="number" name="nis" placeholder="Masukkan NIS" value="{{ old('nis', $siswa->nis) }}"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Jenis Biaya</label>
                    <input type="text" name="jenis_biaya" placeholder="Masukkan Jenis Biaya"
                        value="{{ old('jenis_biaya', $siswa->tagihan[0]->jenis_biaya ?? '') }}" required>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <input type="text" name="total_tagihan" placeholder="Masukkan Total Tagihan"
                            value="{{ old('total_tagihan', $siswa->tagihan[0]->total_tagihan ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" required>
                            <option selected disabled>Status</option>
                            <option value="Lunas" {{ old('status', $tagihan->status) == 'Lunas' ? 'selected' : '' }}>Lunas
                            </option>
                            <option value="Belum Bayar"
                                {{ old('status', $tagihan->status) == 'Belum Bayar' ? 'selected' : '' }}>Belum Lunas
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Created</label>
                        <input type="date" name="created"
                            value="{{ old('created', $siswa->tagihan[0]->created_at->format('Y-m-d') ?? '') }}">

                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn-add">Simpan Perubahan</button>
                </div>
        </form>
    </div>
@endsection
