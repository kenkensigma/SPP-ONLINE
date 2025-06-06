<?php

namespace App\Http\Controllers;

use App\Models\TagihanSiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPembayaran = TagihanSiswa::sum('total_tagihan');

        return view('home', compact('totalPembayaran'));
    }
}
