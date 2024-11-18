<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\QuizJawaban;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuizController extends Controller
{
    public function attempt($quiz_id) {
        date_default_timezone_set('Asia/Jakarta');

        $quiz = Quizz::find($quiz_id);
        if (!$quiz) return back()->withErrors('terjadi kesalahan');
        if ($quiz->tanggal_mulai < date('Y-m-d H:i:s')) return back()->withErrors('quiz belum dibuka');
        elseif ($quiz->tanggal_selesai <= date('Y-m-d H:i:s')) return back()->withErrors('quiz telah berakhir');

        $attempt = QuizAttempt::where('user_id', Auth::user()->id)
            ->where('quiz_id', $quiz_id)
            ->first();
        
        if (!$attempt) QuizAttempt::create([
            'user_id' => Auth::user()->id,
            'quiz_id' => $quiz_id,
            'status' => 'in_progress',
            'started_at' => date('Y-m-d H:i:s')
        ]);
        elseif ($attempt->status != 'in_progress') return back()->withErrors('quiz telah disubmit');

        return 'quiz attempt';
        // return view('<quiz view path>', ['quiz' => $quiz]);
    }

    public function submit($quiz_id, Request $request) {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'quiz_data' => 'required|array',
            'quiz_data.*.soal_id' => 'required|number',
            // 'quiz_data.*.point' => 'required|number',
            'quiz_data.*.jawaban' => 'required|array',
            'quiz_data.*.jawaban.*.opsi' => 'required|string',
            'quiz_data.*.jawaban.*.is_correct' => 'required|boolean',
        ]);

        $attempt = QuizAttempt::where('user_id', Auth::user()->id)
            ->where('quiz_id', $quiz_id)
            ->first();
        if (!$attempt) return back()->withErrors('terjadi kesalahan');
        if ($attempt->status != 'in_progress') return back()->withErrors('quiz telah disubmit');

        foreach ($request->quiz_data as $soal) {
            QuizJawaban::create([
                'attempt_id' => $attempt->id,
                'soal_id' => $soal['soal_id'],
                'jawaban' => $soal['jawaban']['opsi'],
                'is_correct' => $soal['jawaban']['is_correct']??false ? true : false,
                'point_earned' => 0, // dummy
            ]);
        }

        $attempt->update([
            'status' => 'submitted',
            'submitted_at' => date('Y-m-d H:i:s'),
            'score' => 0 // dummy
        ]);
        return 'quiz submitted';
        // return redirect()->route('<quiz kegiatan page route>')->with('success', 'quiz submitted');
    }
}
