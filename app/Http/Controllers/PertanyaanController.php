<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use App\Models\Quizz;

class PertanyaanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'pertanyaan.*' => 'required|string|max:255',
            'kategori_soal.*' => 'required|string|in:essai,pilihan_ganda,pilihan_ganda_multiple',
            'is_required.*' => 'sometimes|boolean',
        ]);

        // Simpan data ke database
        $quiz = new Quizz();
        $quiz->kegiatan_id = $request->kegiatan_id;
        $quiz->judul = $request->judul;
        $quiz->deskripsi = $request->deskripsi;
        $quiz->tanggal_mulai = $request->tanggal_mulai;
        $quiz->tanggal_selesai = $request->tanggal_selesai;
        $quiz->save();

        foreach ($request->pertanyaan as $index => $pertanyaan) {
            // Create a new question entry
            $question = new Soal();
            $question->quiz_id = $quiz->id;
            $question->pertanyaan = $pertanyaan;
            $question->kategori_soal = $request->kategori_soal[$index];
            //$question->is_required = isset($request->is_required[$index]) && $request->is_required[$index] === 'on';
            $question->save();

            // Handle options for multiple-choice questions
            // if (in_array($question->kategori_soal, ['pilihan_ganda', 'pilihan_ganda_multiple'])) {
            //     $options = $request->input("options.$index", []); // Get options for this question
            //     foreach ($options as $optionText) {
            //         $option = new Option();
            //         $option->question_id = $question->id;
            //         $option->option_text = $optionText;
            //         $option->save();
            //     }
            // }
        }

        // Kembalikan respons
        return redirect()->route('quizz.index')->with('success', 'Kuis berhasil ditambahkan!');
    }
}
