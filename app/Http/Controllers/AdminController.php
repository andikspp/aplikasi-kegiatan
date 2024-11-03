<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Kegiatan;
use App\Models\PeranKegiatan;

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
        $kegiatans = Kegiatan::all();

        return view('admin.menu.kegiatan', compact('kegiatans'));
    }

    public function tambahKegiatan()
    {
        $roles = ['Tata Kelola', 'Kemitraan', 'Publikasi', 'Pembelajaran', 'PAUD HI', 'Tata Usaha'];

        $perans = ['Narasumber', 'Fasilitator', 'Panitia'];

        return view('admin.menu.tambah-kegiatan', compact('roles', 'perans'));
    }

    public function qrcode()
    {
        return view('admin.menu.qrcode');
    }

    public function quizz()
    {
        return view('admin.menu.quizz');
    }

    public function detailKegiatan($id)
    {
        return view('admin.menu.detail-kegiatan', compact('id'));
    }

    public function pertanyaan()
    {
        return view('admin.menu.pertanyaan');
    }

    public function hasilkegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $peran_kegiatan = PeranKegiatan::where('id_kegiatan', $id)->get();

        return view('admin.menu.hasilkegiatan', compact('kegiatan', 'peran_kegiatan'));
    }

    public function kelolapeserta()
    {
        return view('admin.menu.kelolapeserta');
    }

    public function kelolalainya()
    {
        return view('admin.menu.kelolalainya');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && $admin->password === $request->password) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('dashboard')->with('success', 'Berhasil login.');
        }

        return redirect()->back()->with('error', 'Username atau password salah.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/')->with('success', 'Berhasil Logout.');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.menu.profil', compact('user'));
    }
}
