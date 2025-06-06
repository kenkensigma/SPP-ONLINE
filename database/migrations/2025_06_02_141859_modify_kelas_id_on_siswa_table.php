<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
    $table->unsignedBigInteger('kelas_id')->after('nis'); // tambahkan kolom dulu
    $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade'); // baru foreign key
});

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
