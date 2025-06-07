<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TagihanSiswa;

class InformasiController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::all();
        return view('informasi', compact('kelasList'));
    }

    public function fetch(Request $request)
    {
        $kelas = $request->kelas;
        $search = $request->search;

        $siswaQuery = Siswa::with('kelas')
            ->whereHas('kelas', fn($q) => $q->where('nama_kelas', $kelas));

        if ($search) {
            $siswaQuery->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nis', 'like', "%$search%");
            });
        }

        $siswaList = $siswaQuery->get();

        $html = view('partials.card-siswa', compact('siswaList'))->render();

        return response()->json(['html' => $html]);
    }
}
