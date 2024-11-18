<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\IsiBiodataController;
use App\Http\Controllers\KelolapesertaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserQuizController;

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::post('/login', [AdminController::class, 'prosesLogin'])->name('login');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// halaman kuis

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

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/qrcode', [AdminController::class, 'qrcode'])->name('qrcode');

    Route::get('/detail-kegiatan/{id}', [AdminController::class, 'detailKegiatan'])->name('detail-kegiatan');
    Route::post('/pertanyaan/store', [PertanyaanController::class, 'store'])->name('pertanyaan.store');
    Route::get('/kelolapeserta/{id}', [AdminController::class, 'kelolapeserta'])->name('kelolapeserta');
    Route::get('/kelolalainya/{id}', [AdminController::class, 'kelolalainya'])->name('kelolalainnya');
});

Route::get('/user/login', [UserController::class, 'loginPage'])->name('user.login');
Route::post('/user/login', [UserController::class, 'prosesLogin'])->name('user.login.store');
Route::get('/user/register', [UserController::class, 'registerPage'])->name('user.register');
Route::post('/user/register', [UserController::class, 'prosesRegister'])->name('user.register.store');


Route::middleware(['user'])->group(function () {
    Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/kegiatan', [UserController::class, 'kegiatan'])->name('user.kegiatan');
    Route::get('/user/qrcode', [UserController::class, 'qrcode'])->name('user.qrcode');
    Route::get('/user/isi-biodata/{id}', [IsiBiodataController::class, 'index'])->name('isi.biodata');
    Route::post('/user/isi-biodata', [IsiBiodataController::class, 'store'])->name('isi.biodata.store');

    // quiz
    Route::prefix('/user/quiz')->group(function () {
        Route::get('/attempt/{quiz_id}', [UserQuizController::class, 'attempt'])->name('user.quiz.attempt');
        Route::post('/submit/{quiz_id}', [UserQuizController::class, 'submit'])->name('user.quiz.submit');
    });

    Route::get('/kuis/{quizId}', [ExamController::class, 'examPage'])->name('exam.page');
    Route::get('/kuis/{quizId}/{quizAttemptId}', [ExamController::class, 'examQuestionPage'])->name('exam.question');
    Route::post('/kuis/{quizId}/start', [ExamController::class, 'start'])->name('exam.start');
    Route::post('/kuis/{quizAttemptId}/submit', [ExamController::class, 'submit'])->name('exam.submit');
    Route::get('/kuis/{attempt}/results', [ExamController::class, 'questionPage'])->name('exam.question.page');
});
