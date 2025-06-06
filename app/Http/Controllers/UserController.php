<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua petugas
    public function user()
    {
        $petugas = Petugas::all();
        return view('user', compact('petugas'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.user-add');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,wali-guru'
        ]);

        // Enkripsi password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);
        Petugas::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    // Form edit user
    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.user-edit', compact('petugas'));
    }

public function update(Request $request, string $id)
{
    $petugas = Petugas::findOrFail($id);

    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:petugas,email,' . $petugas->id,
        'password' => 'nullable|string|min:6',
        'role' => 'required|string|in:admin,wali-guru'
    ]);

    // Jika password diisi, hash dulu
    if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        // Kalau password kosong, hapus dari data yang akan diupdate supaya password lama tetap
        unset($validatedData['password']);
    }

    $petugas->update($validatedData);

    return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
}


    // Hapus user
    public function destroy(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('user.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
