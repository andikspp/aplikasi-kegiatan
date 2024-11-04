<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IsiBiodataController extends Controller
{
    public function index()
    {
        return view('admin.menu.isibiodata');
    }
}