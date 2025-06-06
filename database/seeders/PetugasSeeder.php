<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'nama' => 'AdminSPP',
            'email' => 'admin2@spp.com',
            'password' => Hash::make('adminspp69'), // password bisa apa aja
            'role' => 'guru'
        ]);
    }
}
