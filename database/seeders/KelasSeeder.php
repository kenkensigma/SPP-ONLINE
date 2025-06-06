<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 2, 'nama_kelas' => 'XI RPL 2'],
            ['id' => 3, 'nama_kelas' => 'XI TKJ 1'],
            ['id' => 4, 'nama_kelas' => 'XI TKJ 2'],
            ['id' => 5, 'nama_kelas' => 'XI DKV'],
            ['id' => 6, 'nama_kelas' => 'XI AKL 1'],
            ['id' => 7, 'nama_kelas' => 'XI AKL 2'],
            ['id' => 8, 'nama_kelas' => 'XI OTKP 1'],
            ['id' => 9, 'nama_kelas' => 'XI OTKP 2'],
            ['id' => 10, 'nama_kelas' => 'XI BDP'],
            ['id' => 11, 'nama_kelas' => 'XI MPLB'],
            ['id' => 12, 'nama_kelas' => 'XI TJKT 1'],
            ['id' => 13, 'nama_kelas' => 'XI TJKT 2'],
        ];

        foreach ($data as $kelas) {
            Kelas::updateOrCreate(['id' => $kelas['id']], $kelas);
        }
    }
}


