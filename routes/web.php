<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/kelas/data', [KelasController::class, 'getDataByKelas'])->name('kelas.data');


Route::get('/', function () {
    return view('auth/login');
});

Route::group([
    "middleware" => "guest"
], function(){

    // Login
    Route::match(["get", "post"], "login", [AuthController::class, "login"])->name("login");

});

Route::group([
    "middleware" => "auth"
], function(){

    // Dashboard
    Route::get("home", [AuthController::class, "dashboard"])->name("home");


    // Profile
    //Route::get("profile", [AuthController::class, "profile"])->name("profile");
    Route::match(["get", "post"], "profile", [AuthController::class, "profile"])->name("profile");

    // Logout
    Route::get("logout", [AuthController::class, "logout"])->name("logout");

});


Route::get('/user', [UserController::class, 'user'])->name('user.index');          // Tampil semua user
Route::get('/user-add', [UserController::class, 'create'])->name('user.add'); // Form tambah user
Route::post('/user', [UserController::class, 'store'])->name('user.store');         // Simpan user baru
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');  // Form edit user
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');   // Update user
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Hapus user


Route::resource('kelas', KelasController::class);

Route::get('/kelas/export/{kelas}', [KelasController::class, 'export'])->name('kelas.export');
Route::get('/kelas/{kelas}', [KelasController::class, 'show']);
Route::get('/home', [DashboardController::class, 'index']);

