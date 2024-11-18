<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Kegiatan;
use App\Models\PeranKegiatan;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        $totalKegiatan = Kegiatan::count();
        $kegiatanMendatang = Kegiatan::where('tanggal_kegiatan', '>', Carbon::now())->count();
        $kegiatanSelesai = Kegiatan::where('tanggal_kegiatan', '<', Carbon::now())->count();

        return view('admin.menu.dashboard', compact('totalKegiatan', 'kegiatanSelesai', 'kegiatanMendatang'));
    }

    public function kegiatan()
    {
        $kegiatans = Kegiatan::paginate(10);

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

    public function profile()
    {
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('admin.menu.profil', compact('user')); // Kirim variabel ke view
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
        $kegiatans = Kegiatan::all();

        return view('admin.menu.pertanyaan', compact('kegiatans'));
    }

    public function hasilkegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $peran_kegiatan = PeranKegiatan::where('id_kegiatan', $id)->get();

        return view('admin.menu.hasilkegiatan', compact('kegiatan', 'peran_kegiatan'));
    }

    public function kelolapeserta($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('admin.menu.kelolapeserta', compact('kegiatan'));
    }

    public function kelolalainya($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('admin.menu.kelolalainya', compact('kegiatan'));
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
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
