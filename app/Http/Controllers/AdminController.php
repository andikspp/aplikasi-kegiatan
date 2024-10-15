<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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
        return view('admin.menu.hasilkegiatan');
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
        $request->session()->invalidate(); // Menghapus semua data sesi
        $request->session()->regenerateToken(); // Menghasilkan token CSRF baru

        return redirect()->to('/')->with('success', 'Berhasil Logout.');
    }
}
