<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/kegiatan', [AdminController::class, 'kegiatan'])->name('kegiatan');
Route::get('/tambah-kegiatan', [AdminController::class, 'tambahKegiatan'])->name('tambah-kegiatan');
Route::get('/qrcode', [AdminController::class, 'qrcode'])->name('qrcode');
Route::get('/peserta', [AdminController::class, 'peserta'])->name('peserta');
Route::get('/detail-kegiatan/{id}', [AdminController::class, 'detailKegiatan'])->name('detail-kegiatan');
