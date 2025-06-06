<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Mapping data NIS, nama, dan nama_kelas
        $siswaData = [
            ['30935', 'ALFONSUS WELA', 'XI RPL 1'],
            ['30936', 'GEDE RADITYA SYANDANA EDI SAPUTRA', 'XI RPL 1'],
            ['30938', 'KADEK WAHYU MERTA JAYA', 'XI RPL 1'],
            ['30939', 'I KETUT PURNA ADITYA', 'XI RPL 1'],
            ['30940', 'I KOMANG BISMA PURNAWARMAN', 'XI RPL 1'],
            ['30941', 'I MADE AGUS DITYA DARMA PUTRA', 'XI RPL 1'],
            ['30942', 'I MADE CAKA DARMDWIKA', 'XI RPL 1'],
            ['30943', 'I MADE DIO SURADINATA', 'XI RPL 1'],
            ['30944', 'I MADE DWIPAYANA PUTRA', 'XI RPL 1'],
            ['30945', 'I NYOMAN ANDIKA PRATAMA', 'XI RPL 1'],
            ['30946', 'I NYOMAN PUTRA SEDANA', 'XI RPL 1'],
            ['30947', 'I PUTU GUNA PRATAMA', 'XI RPL 1'],
            ['30948', 'I PUTU PANDE DANU YASA', 'XI RPL 1'],
            ['30949', 'I WAYAN BAGUS PRASETYA', 'XI RPL 1'],
            ['30950', 'KADEK VIAN INDRASTA PRAMANA', 'XI RPL 1'],
            ['30951', 'KETUT RADITYAGANA', 'XI RPL 1'],
            ['30952', 'KOMANG ARCHIE PUTRA', 'XI RPL 1'],
            ['30953', 'NAUFAL MAULA PRATAMA', 'XI RPL 1'],
            ['30954', 'NI KADEK PUTRI PERMATA SARI', 'XI RPL 1'],
            ['30955', 'PANDE PUTU OKTA ADYNYANA SUPUTRA', 'XI RPL 1'],
            ['30956', 'PUTU SATYA SUASTIKA', 'XI RPL 1'],
            ['30957', 'RASYA PUTRA FIRMANSYAH', 'XI RPL 1'],
            ['30958', 'RIZQY NABILL NABAWI', 'XI RPL 1'],
            ['30959', 'SILVANUS JOSHUA NATILI', 'XI RPL 1'],
            ['30960', 'ZAHRATU SYITA EGWAR', 'XI RPL 1'],
            ['31015', 'JULIA ARISTA', 'XI RPL 2'],
        ];

        foreach ($siswaData as [$nis, $nama, $namaKelas]) {
            if (!Siswa::where('nis', $nis)->exists()) {

                // Cari ID kelas berdasarkan nama_kelas
                $kelas = Kelas::where('nama_kelas', $namaKelas)->first();

                // Kalau kelas belum ada, skip siswa ini
                if (!$kelas) {
                    continue;
                }

                $siswa = Siswa::create([
                    'nis' => $nis,
                    'nama' => $nama,
                    'kelas_id' => $kelas->id,
                ]);

                $siswa->tagihan()->createMany([
                    [
                        'jenis_biaya' => 'SPP',
                        'total_tagihan' => 150000,
                        'status' => $faker->randomElement(['Lunas', 'Belum Bayar']),
                    ],
                    [
                        'jenis_biaya' => 'Komite',
                        'total_tagihan' => 50000,
                        'status' => $faker->randomElement(['Lunas', 'Belum Bayar']),
                    ],
                ]);
            }
        }
    }
}
