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

        // Ambil semua kelas dari database
        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            // Jumlah siswa per kelas (misal 10, sesuaikan jika perlu)
            $jumlahSiswa = 10;

            for ($i = 0; $i < $jumlahSiswa; $i++) {
                $nis = $faker->unique()->numberBetween(31020, 31999); // pastikan unik
                $nama = strtoupper($faker->name());

                // Hindari duplikat berdasarkan NIS
                if (!Siswa::where('nis', $nis)->exists()) {
                    $siswa = Siswa::create([
                        'nis' => $nis,
                        'nama' => $nama,
                        'kelas_id' => $kelas->id,
                    ]);

                    // Tambahkan tagihan (2 jenis default)
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
}
