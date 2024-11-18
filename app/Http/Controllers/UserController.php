<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'nama' => 'required|string|max:255',
        ]);

        // Buat pengguna baru dengan password default '654321'
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'nama' => $validatedData['nama'],
            'password' => Hash::make('654321'), // Hash password dengan bcrypt
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
        return view('user.menu.dashboard');
    }

    public function kegiatan()
    {
        $kegiatan = null;
        return view('user.menu.kegiatan.index');
    }

    public function qrcode()
    {
        return view('user.menu.qrcode.index');
    }
}
