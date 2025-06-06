@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.sidebar')

@section('title', 'User')

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

    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <div class="page-header">
        <h1>User</h1>
    </div>

    <div class="main-main">
        <div class="user-content">
            <div class="user-card">
                <h3>Data User</h3>
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('user.add') }}" class="btn-tambah">Tambah Data</a>
                @endif
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($petugas as $ondesk => $item)
                            <tr>
                                <td>{{ $ondesk + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                @if (Auth::user()->role === 'admin')
                                    <td class="kolom-aksi">
                                        <a href="{{ route('user.edit', $item->id) }}" class="btn-edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td class="kolom-aksi">
                                        <span class="text-muted">-</span>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
