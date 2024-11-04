<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Models\Quizz;

class QuizzController extends Controller
{
    public function index()
    {
        $quizzes = Quizz::all();
        return view('admin.menu.quizz', compact('quizzes'));
    }
}
