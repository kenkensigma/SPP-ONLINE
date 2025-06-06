<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $kelas;

    public function __construct($kelas)
    {
        $this->kelas = $kelas;
    }

    public function collection()
    {
        return Siswa::with(['kelas', 'tagihan'])
            ->whereHas('kelas', function ($query) {
                $query->where('nama_kelas', $this->kelas);
            })
            ->get()
            ->map(function ($siswa) {
                $tagihan = $siswa->tagihan->first();

                return [
                    'NIS' => $siswa->nis,
                    'Nama' => $siswa->nama,
                    'Kelas' => $siswa->kelas->nama_kelas ?? '-',
                    'Jenis Biaya' => $tagihan->jenis_biaya ?? '-',
                    'Total Tagihan' => $tagihan->total_tagihan ?? '-',
                    'Status' => $tagihan->status ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Kelas', 'Jenis Biaya', 'Total Tagihan', 'Status'];
    }
}
