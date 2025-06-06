<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; // ⬅️ Tambahkan ini

    protected $fillable = ['nis', 'nama', 'kelas_id'];

    public function tagihan()
    {
        return $this->hasMany(TagihanSiswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
