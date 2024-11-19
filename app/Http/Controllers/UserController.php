<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function loginPage()
    {
        return view('user.auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba autentikasi dengan username atau email
        $field = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']])) {
            // Autentikasi berhasil
            $request->session()->regenerate();

            return redirect()->route('user.dashboard')->with('success', 'Login Berhasil');
        }

        // Autentikasi gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function registerPage()
    {
        return view('user.auth.register');
    }

    public function prosesRegister(Request $request)
    {
        // Validasi input yang diterima dari form
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',  // Pastikan username unik
            'email' => 'required|email|max:255|unique:users',  // Pastikan email unik
            'nama' => 'required|string|max:255',  // Nama wajib diisi
            'nip' => 'nullable|string|max:20|unique:users',  // NIP opsional dan harus unik jika diisi
        ]);

        // Buat pengguna baru dengan password default '654321'
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],  // Menyimpan NIP jika diisi
            'password' => Hash::make('654321'),  // Hash password dengan bcrypt
        ]);

        // Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('user.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/user/login')->with('success', 'Berhasil Logout.');
    }


    public function dashboard()
    {
        $user = Auth::user();

        $jumlahKegiatan = Peserta::where('user_id', $user->id)->count();

        $kegiatanMendatang = Peserta::where('user_id', $user->id)
            ->join('kegiatans', 'peserta.kegiatan_id', '=', 'kegiatans.id')
            ->where('kegiatans.tanggal_kegiatan', '>', now())
            ->count();

        $kegiatanSelesai = Peserta::where('user_id', $user->id)
            ->join('kegiatans', 'peserta.kegiatan_id', '=', 'kegiatans.id')
            ->where('kegiatans.tanggal_kegiatan', '<', now())
            ->count();

        return view('user.menu.dashboard.dashboard', compact('jumlahKegiatan', 'kegiatanMendatang', 'kegiatanSelesai'));
    }

    public function kegiatan()
    {
        $user = Auth::user();

        // Ambil data kegiatan yang diikuti oleh user beserta jumlah pesertanya
        $kegiatanList = Peserta::where('user_id', $user->id)
            ->with(['kegiatan', 'kegiatan.peserta']) // Mengambil data kegiatan dan jumlah peserta
            ->get();

        return view('user.menu.kegiatan.index', compact('kegiatanList'));
    }


    public function qrcode()
    {
        return view('user.menu.qrcode.index');
    }

    public function editKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $peserta = Peserta::where('kegiatan_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('user.menu.kegiatan.edit', compact('kegiatan', 'peserta'));
    }

    public function destroyKegiatan($id)
    {
        $peserta = Peserta::findOrFail($id);

        if ($peserta->file_upload && Storage::disk('public')->exists($peserta->file_upload)) {
            Storage::disk('public')->delete($peserta->file_upload);
        }

        $peserta->delete();

        return redirect()->route('user.kegiatan', ['id' => $peserta->kegiatan_id])->with('success', 'Data anda berhasil dihapus');
    }
}
