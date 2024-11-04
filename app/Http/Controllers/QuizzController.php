<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;

class QuizzController extends Controller
{
    public function index()
    {
        $quizzes = Quizz::all();
        return view('admin.menu.quizz', compact('quizzes'));
    }

    public function store(Request $request)
    {
    // Validasi data
    $request->validate([
        'nama_quiz' => 'required|string|max:255',
        'tanggal_buka' => 'required|date',
        'tanggal_tutup' => 'required|date',
        'pertanyaan.*' => 'required|string',
        'kategori_soal.*' => 'required|string',
    ]);

    // Simpan data quizz
    $quizz = Quizz::create([
        'kegiatan_id' => $request->kegiatan_id, // Pastikan ini ada di request
        'nama_quiz' => $request->nama_quiz,
        'tanggal_buka' => $request->tanggal_buka,
        'tanggal_tutup' => $request->tanggal_tutup,
    ]);

    // Simpan pertanyaan terkait
    foreach ($request->pertanyaan as $index => $soal) {
        Pertanyaan::create([
            'quizz_id' => $quizz->id,
            'pertanyaan' => $soal,
            'kategori_soal' => $request->kategori_soal[$index],
            'deskripsi' => $request->deskripsi[$index] ?? null,
        ]);
    }

    return response()->json(['success' => true, 'message' => 'Quizz dan pertanyaan berhasil disimpan!']);
    }
}