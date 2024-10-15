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

    public function kegiatan()
    {
        return view('admin.menu.kegiatan');
    }

    public function tambahKegiatan()
    {
        return view('admin.menu.tambah-kegiatan');
    }

    public function qrcode()
    {
        return view('admin.menu.qrcode');
    }

    public function peserta()
    {
        return view('admin.menu.peserta');
    }

    public function detailKegiatan($id)
    {
        return view('admin.menu.detail-kegiatan', compact('id'));
    }
    
    public function pertanyaan()
    {
        return view('admin.menu.pertanyaan');
    }

    public function hasilkegiatan()
    {
        return view('admin.menu.hasilkegiatan'); // Pastikan view ini ada
    }

    public function kelolapeserta()
    {
        return view('admin.menu.kelolapeserta');
    }

    public function kelolalainya()
    {
        return view('admin.menu.kelolalainya');
    }
}