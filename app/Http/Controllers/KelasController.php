<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TagihanSiswa;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas', compact('kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all(); // Ambil semua data kelas

        return view('admin.table-add', compact('kelas')); // Kirim ke view

    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama' => 'required|string|max:255',
            'nis' => 'required|integer|min:5',
            'jenis_biaya' => 'required|string|max:255',
            'total_tagihan' => 'required|numeric|digits_between:1,6',
            'status' => 'required|in:Lunas,Belum Bayar',
            'created' => 'required|date',
        ]);


        $siswa = Siswa::create([
            'kelas_id' => $validated['kelas_id'],
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
        ]);


        $siswa->tagihan()->create([
            'jenis_biaya' => $validated['jenis_biaya'],
            'total_tagihan' => $validated['total_tagihan'],
            'status' => $validated['status'],
            'created_at' => $validated['created'],
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Request $request, $kelas)
{
    $search = $request->search;

    $siswa = Siswa::with('tagihan', 'kelas')
        ->whereHas('kelas', function ($query) use ($kelas) {
            $query->where('nama_kelas', $kelas);
        })
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('nis', 'like', '%' . $search . '%');
            });
        })
        ->get();

    if ($siswa->isEmpty()) {
        return response()->json(['html' => '<p style="text-align:center;">Data invalid atau belum ada siswa di kelas ini.</p>']);
    }

    $html = view('partials.tabel-tagihan', compact('siswa', 'kelas'))->render();
    return response()->json(['html' => $html]);
}


    public function edit($id)
    {
        $siswa = Siswa::with('tagihan')->findOrFail($id);
        $kelas = Kelas::all(); // ✅ ambil semua kelas
        $tagihan = $siswa->tagihan->first();

        return view('admin.table-edit', compact('siswa', 'kelas', 'tagihan'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('tagihan')->findOrFail($id);

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama' => 'required|string|max:255',
            'nis' => 'required|integer|min:5',
            'jenis_biaya' => 'required|string|max:255',
            'total_tagihan' => 'required|numeric|digits_between:1,6',
            'status' => 'required|in:Lunas,Belum Bayar',
            'created' => 'required|date',
        ]);

        $siswa->update([
            'kelas_id' => $validated['kelas_id'],
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
        ]);

        $siswa->tagihan()->updateOrCreate(
            ['siswa_id' => $siswa->id],
            [
                'jenis_biaya' => $validated['jenis_biaya'],
                'total_tagihan' => $validated['total_tagihan'],
                'status' => $validated['status'],
                'created_at' => $validated['created'],
            ]
        );

        return redirect()->route('kelas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->tagihan()->delete();
        $siswa->delete();

        return redirect()->route('kelas.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function export($kelas)
    {
        $kelasModel = Kelas::where('nama_kelas', $kelas)->firstOrFail();
        $namaFile = 'siswa-' . str_replace(' ', '-', strtolower($kelasModel->nama_kelas)) . '.xlsx';

        return Excel::download(new SiswaExport($kelasModel->nama_kelas), $namaFile);
    }
}
