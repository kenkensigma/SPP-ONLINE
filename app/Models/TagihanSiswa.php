<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    protected $table = 'tagihan_siswa'; // ⬅️ Tambahkan ini

    protected $fillable = ['siswa_id', 'jenis_biaya', 'total_tagihan', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
