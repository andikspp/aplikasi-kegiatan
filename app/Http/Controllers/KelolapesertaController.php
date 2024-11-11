<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan; // Pastikan model Kegiatan di-import

class KelolapesertaController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all(); // Ambil semua data kegiatan
        return view('admin.menu.kelolapeserta', compact('kegiatans')); // Kirim variabel ke view
    }
}