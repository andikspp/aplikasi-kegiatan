<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\IsiBiodataController;
use App\Http\Controllers\KelolapesertaController;

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::post('/login', [AdminController::class, 'prosesLogin'])->name('login');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kegiatan
    Route::get('/kegiatan', [AdminController::class, 'kegiatan'])->name('kegiatan');
    Route::post('/kegiatan-store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('/kegiatan-update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::get('/hasilkegiatan/{id}', [AdminController::class, 'hasilkegiatan'])->name('hasilkegiatan');
    Route::get('/kegiatan-delete/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.delete');
    Route::get('/tambah-kegiatan', [AdminController::class, 'tambahKegiatan'])->name('tambah-kegiatan');

    // Kuis
    Route::get('/quizz', [QuizzController::class, 'index'])->name('quizz.index');
    Route::get('/pertanyaan', [AdminController::class, 'pertanyaan'])->name('pertanyaan');
    Route::post('/kuis-store', [PertanyaanController::class, 'store'])->name('kuis.store');

    //pengguna
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/qrcode', [AdminController::class, 'qrcode'])->name('qrcode');

    Route::get('/detail-kegiatan/{id}', [AdminController::class, 'detailKegiatan'])->name('detail-kegiatan');
    Route::post('/pertanyaan/store', [PertanyaanController::class, 'store'])->name('pertanyaan.store');
    Route::get('/kelolapeserta', [KelolapesertaController::class, 'index'])->name('kelolapeserta');
    Route::get('/kelolalainya', [AdminController::class, 'kelolalainya'])->name('kelolalainnya');
    Route::get('/isi-biodata', [IsiBiodataController::class, 'index'])->name('isi.biodata');
    Route::post('/isi-biodata', [IsiBiodataController::class, 'store'])->name('isi.biodata.store');
});
