<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        return view('admin.menu.dashboard');
    }
}
