<?php

namespace App\Http\Controllers;

use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

            // Coba ambil petugas berdasarkan email
            $petugas = Petugas::where('email', $request->email)->first();

            // Cek apakah ada dan password cocok
            if ($petugas && Hash::check($request->password, $petugas->password)) {
                Auth::login($petugas);

                // Redirect berdasarkan role/level (kalau pakai field `level`)
                // if ($petugas->level === 'admin') {
                //     return redirect()->route('admin.dashboard');
                // }

                return redirect()->route('home');
            } else {
                return redirect()->route("login")->with("error", "Email atau password salah.");
            }
        }

        return view("auth.login");
    }

    // Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        $totalPembayaran = TagihanSiswa::sum('total_tagihan');

        return view('home', compact('user', 'totalPembayaran'));
    }

    // Logout
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route("login")->with("success", "Berhasil logout.");
    }
}
