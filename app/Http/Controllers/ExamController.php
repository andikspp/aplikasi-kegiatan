<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function examPage()
    {
        return view('layouts.menu.exam-page');
    }
}
