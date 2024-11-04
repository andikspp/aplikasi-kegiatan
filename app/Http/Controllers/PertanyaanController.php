<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;

class PertanyaanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        // Simpan data ke database
        $pertanyaan = new Quizz();
        $pertanyaan->judul = $request->judul;
        $pertanyaan->deskripsi = $request->deskripsi;
        $pertanyaan->tanggal_mulai = $request->tanggal_mulai;
        $pertanyaan->tanggal_selesai = $request->tanggal_selesai;
        $pertanyaan->save();

        // Kembalikan respons
        return response()->json(['success' => true, 'message' => 'Pertanyaan berhasil disimpan!']);
    }
}
