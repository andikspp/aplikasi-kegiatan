<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PeranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/qrcode', [AdminController::class, 'qrcode'])->name('qrcode');
    Route::get('/quizz', [AdminController::class, 'quizz'])->name('quizz');
    Route::get('/detail-kegiatan/{id}', [AdminController::class, 'detailKegiatan'])->name('detail-kegiatan');
    Route::get('/pertanyaan', [AdminController::class, 'pertanyaan'])->name('pertanyaan');
    Route::get('/kelolapeserta', [AdminController::class, 'kelolapeserta'])->name('kelolapeserta');
    Route::get('/kelolalainya', [AdminController::class, 'kelolalainya'])->name('kelolalainnya');
    Route::get('/profil', [AdminController::class, 'profil'])->name('profil');
});
