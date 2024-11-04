<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan; // Pastikan model Pertanyaan di-import
use App\Models\Quizz; // Pastikan model Quizz di-import

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
            'syarat_unduh' => 'required|string',
            'pertanyaan' => 'required|array',
            'kategori_soal' => 'required|array',
        ]);

        // Simpan pertanyaan
        $pertanyaan = Pertanyaan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        // Simpan soal terkait dengan pertanyaan
        foreach ($request->pertanyaan as $index => $soal) {
            // Simpan setiap soal ke dalam tabel soal (jika ada tabel soal)
            // Misalnya, jika Anda memiliki model Soal
            // Soal::create([
            //     'pertanyaan_id' => $pertanyaan->id,
            //     'soal' => $soal,
            //     'kategori_soal' => $request->kategori_soal[$index],
            // ]);
        }

        return response()->json(['success' => true, 'message' => 'Pertanyaan berhasil disimpan!']);
    }
}