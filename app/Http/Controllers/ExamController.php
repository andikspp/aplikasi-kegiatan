<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;
use App\Models\QuizAttempt;
use App\Models\QuizJawaban;
use App\Models\Soal;
use Auth;

class ExamController extends Controller
{
    public function examPage($quizId)
    {
        $user = auth()->user();
        $quiz = Quizz::where('id', $quizId)->first();

        if (!$quiz) {
            return redirect()->route('user.dashboard')->with('error', 'Kuis tidak ditemukan');
        }

        $attempt = QuizAttempt::where('user_id', $user->id)
                            ->where('quiz_id', $quiz->id)
                            ->orderBy('created_at', 'desc')
                            ->first();

        return view('layouts.menu.exam-page', compact('quiz', 'attempt'));
    }

    public function examQuestionPage($quizId, $quizAttemptId)
    {
        $quiz = Quizz::with(['soal' => function ($query) {
            $query->with(['jawaban' => function ($query) {
                $query->select('id', 'soal_id', 'jawaban');
            }]);
        }])->where('id', $quizId)->first();

        $attempt = QuizAttempt::where('id', $quizAttemptId)->first();

        if (!$quiz || !$attempt) {
            return redirect()->route('user.dashboard')->with('error', 'Kuis atau percobaan kuis tidak ditemukan');
        }

        return view('layouts.menu.exam-page-question', compact('quiz', 'quizAttemptId'));
    }

    public function start(string $quizId)
    {
        $user = Auth::user();
        $quiz = Quizz::findOrFail($quizId);

        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quizId,
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return redirect()->route('exam.question', ['quizId' => $quizId, 'quizAttemptId' => $attempt->id]);
    }

    public function submit(string $quizAttemptId, Request $request)
    {
        $attempt = QuizAttempt::findOrFail($quizAttemptId);

        $attempt->update([
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        $isEssay = false;
        $essayScore = 0;
        $totalScore = 0;
        $singleMultipleChoiceScore = 0;

        // Get all soal in the quiz
        $quizId = $attempt->quiz_id;
        $soalList = Soal::where('quizz_id', $quizId)->get();

        foreach ($request->answers as $answerData) {
            $soal = $soalList->firstWhere('id', $answerData['soal_id']);

            $isCorrect = false;
            $pointEarned = 0;
            $jawaban = $answerData['jawaban'] ?? '';

            if (!is_null($jawaban) && $jawaban !== '') {
                switch ($soal->kategori_soal) {
                    case 'single_choice':
                        $correctOption = $soal->jawaban()->where('is_correct', true)->first();
                        $isCorrect = $correctOption && $correctOption->id == $soal->jawaban[intval($jawaban[0])]['id'];
                        $pointEarned = $isCorrect ? $soal->point : 0;
                        $singleMultipleChoiceScore += $pointEarned;
                        break;

                    case 'multiple_choice':
                        $correctOptions = $soal->jawaban()->where('is_correct', true)->pluck('id')->toArray();
                        $selectedOptions = is_array($jawaban) ? $jawaban : [$jawaban];

                        $correctCount = count(array_intersect($correctOptions, $selectedOptions));
                        $incorrectCount = count(array_diff($selectedOptions, $correctOptions));

                        if ($correctCount > 0 && $incorrectCount == 0) {
                            $isCorrect = true;
                            $pointEarned = $soal->point * ($correctCount / count($correctOptions));
                            $singleMultipleChoiceScore += $pointEarned;
                        }
                        break;

                    case 'essay':
                        $isEssay = true;
                        $pointEarned = $soal->point;
                        $essayScore += $pointEarned;
                        break;
                }
            }

            QuizJawaban::create([
                'attempt_id' => $attempt->id,
                'soal_id' => $soal->id,
                'jawaban' => is_array($jawaban) ? json_encode($jawaban) : ($jawaban ?: ''),
                'is_correct' => $isCorrect,
                'point_earned' => $pointEarned,
            ]);

            $totalScore += $pointEarned;
        }

        $singleMultipleChoiceScore = ($attempt->quiz->total_point - $essayScore) * ($singleMultipleChoiceScore / ($totalScore - $essayScore));

        if ($isEssay) {
            $attempt->update([
                'status' => 'submitted',
                'score' => $essayScore,
            ]);
        } else {
            $attempt->update([
                'status' => 'graded',
                'score' => $singleMultipleChoiceScore + $essayScore,
            ]);
        }

        return response()->json($attempt->load('jawaban'), 200);
    }
}
