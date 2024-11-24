<?php

namespace App\Http\Controllers;

use App\Models\OpsiJawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use App\Models\Quizz;

class PertanyaanController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->quiz_data);
        // Validasi data
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'quiz_data' => 'required|array',
            'quiz_data.*.pertanyaan' => 'required|string',
            'quiz_data.*.kategori_soal' => 'required|string',
            'quiz_data.*.is_required' => 'boolean',
            'quiz_data.*.pilihan' => 'array',
            'quiz_data.*.pilihan.*.opsi' => 'string',
            'quiz_data.*.pilihan.*.jawaban' => 'boolean',
            // 'pertanyaan.*' => 'required|string|max:255',
            // 'kategori_soal.*' => 'required|string|in:essai,pilihan_ganda,pilihan_ganda_multiple',
            // 'is_required.*' => 'sometimes|boolean',
        ]);

        // Simpan data ke database
        // $quiz = new Quizz();
        // $quiz->kegiatan_id = $request->kegiatan_id;
        // $quiz->judul = $request->judul;
        // $quiz->deskripsi = $request->deskripsi;
        // $quiz->tanggal_mulai = $request->tanggal_mulai;
        // $quiz->tanggal_selesai = $request->tanggal_selesai;
        // $quiz->save();

        $quiz = Quizz::create([
            'kegiatan_id' => $request->kegiatan_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        // dd($quiz->id);

        foreach ($request->quiz_data as $soal) {
            // dd($soal['is_required']??false);
            $soal = Soal::create([
                'quizz_id' => $quiz->id,
                'pertanyaan' => $soal['pertanyaan'],
                'kategori_soal' => $soal['kategori_soal'],
                'wajib_diisi' => $soal['is_required']??false ? true : false,
                'point' => 10, // dummy
            ]);
            if ($soal['pilihan']??false) foreach ($soal['pilihan'] as $pilihan) {
                OpsiJawaban::create([
                    'soal_id' => $soal['id'],
                    'jawaban' => $pilihan['opsi'],
                    'is_correct' => $pilihan['jawaban']??false ? true : false,
                ]);
            }
            // Create a new question entry
            // $question = new Soal();
            // $question->quiz_id = $quiz->id;
            // $question->pertanyaan = $pertanyaan;
            // $question->kategori_soal = $request->kategori_soal[$index];
            //$question->is_required = isset($request->is_required[$index]) && $request->is_required[$index] === 'on';
            // $question->save();

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
