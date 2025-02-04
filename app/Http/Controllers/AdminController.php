<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Kegiatan;
use App\Models\PeranKegiatan;
use App\Models\User;
use App\Models\Peserta;
use App\Models\PesertaKegiatan;
use App\Models\Quizz;
use App\Models\Pokja;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        $admin = auth()->user();

        if ($admin->role == 'superadmin') {
            $totalKegiatan = Kegiatan::count();
            $kegiatanMendatang = Kegiatan::where('tanggal_kegiatan', '>', Carbon::now())->count();
            $kegiatanSelesai = Kegiatan::where('tanggal_kegiatan', '<', Carbon::now())->count();
            $jumlahPeserta = PesertaKegiatan::count();
            $jumlahPesertaDaftar = PesertaKegiatan::count();
        } else {
            $pokja_id = $admin->pokja_id;
            $totalKegiatan = Kegiatan::where('pokja_id', $pokja_id)->count();
            $kegiatanMendatang = Kegiatan::where('pokja_id', $pokja_id)->where('tanggal_kegiatan', '>', Carbon::now())->count();
            $kegiatanSelesai = Kegiatan::where('pokja_id', $pokja_id)->where('tanggal_kegiatan', '<', Carbon::now())->count();

            $jumlahPesertaDaftar = PesertaKegiatan::whereHas('kegiatan', function ($query) use ($pokja_id) {
                $query->where('pokja_id', $pokja_id);
            })->count();

            $jumlahPeserta = $jumlahPesertaDaftar;
        }

        $jumlahkuis = Quizz::count();

        return view('admin.menu.dashboard', compact('totalKegiatan', 'kegiatanSelesai', 'kegiatanMendatang', 'jumlahPeserta', 'jumlahPesertaDaftar', 'jumlahkuis'));
    }


    public function kegiatan()
    {
        $admin = auth()->user();
        if ($admin->role == 'superadmin') {
            // Superadmin bisa melihat semua kegiatan, dengan pagination
            $kegiatans = Kegiatan::paginate(10); // Menampilkan 10 data per halaman
        } else {
            // Admin berdasarkan pokja_id, dengan pagination
            $pokja_id = $admin->pokja_id;
            $kegiatans = Kegiatan::where('pokja_id', $pokja_id)->paginate(10); // Menampilkan 10 data per halaman
        }

        return view('admin.menu.kegiatan', compact('kegiatans'));
    }

    public function tambahKegiatan()
    {
        $roles = ['Tata Kelola', 'Kemitraan', 'Publikasi', 'Pembelajaran', 'PAUD HI', 'Tata Usaha'];

        $perans = ['Narasumber', 'Fasilitator', 'Panitia'];

        $pokjas = Pokja::all();

        return view('admin.menu.tambah-kegiatan', compact('roles', 'perans', 'pokjas'));
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

        $pokjas = Pokja::all();

        return view('admin.menu.hasilkegiatan', compact('kegiatan', 'peran_kegiatan', 'pokjas'));
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

    public function editPeserta($id)
    {
        // Find the Peserta record by its id
        $peserta = PesertaKegiatan::findOrFail($id);

        // Fetch the related Kegiatan if needed
        $kegiatan = Kegiatan::findOrFail($peserta->kegiatan_id);

        $peranList = PeranKegiatan::where('id_kegiatan', $peserta->kegiatan_id)
            ->pluck('peran');

        // Pass the peserta and kegiatan data to the view
        return view('admin.menu.edit-peserta', compact('peserta', 'kegiatan', 'peranList'));
    }

    public function updatePeserta(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat_golongan' => 'nullable|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'masa_kerja' => 'required|string|max:255',
            'alamat_kantor' => 'required|string|max:255',
            'telp_kantor' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'telp_rumah' => 'required|string|max:20',
            'alamat_email' => 'required|email|max:255',
            'npwp' => 'required|string|max:20',
            'peran' => 'required|string|in:Peserta,Narasumber,Fasilitator,Panitia',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Find the peserta by ID
        $peserta = PesertaKegiatan::findOrFail($id);

        // Update the peserta data
        $peserta->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'nip' => $validated['nip'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'agama' => $validated['agama'],
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
            'jabatan' => $validated['jabatan'],
            'pangkat_golongan' => $validated['pangkat_golongan'],
            'unit_kerja' => $validated['unit_kerja'],
            'masa_kerja' => $validated['masa_kerja'],
            'alamat_kantor' => $validated['alamat_kantor'],
            'telp_kantor' => $validated['telp_kantor'],
            'alamat_rumah' => $validated['alamat_rumah'],
            'telp_rumah' => $validated['telp_rumah'],
            'alamat_email' => $validated['alamat_email'],
            'npwp' => $validated['npwp'],
            'peran' => $validated['peran'],
        ]);

        // Handle the file upload if present
        if ($request->hasFile('file_upload')) {
            // Define the file path
            $filePath = $request->file('file_upload')->store('uploads', 'public');

            // Update the file path in the database
            $peserta->update([
                'file_upload' => $filePath,
            ]);
        }

        // Redirect back to the peserta page with a success message
        return redirect()->route('kelolapeserta', ['id' => $peserta->kegiatan_id])->with('success', 'Peserta berhasil diperbarui.');
    }

    public function destroyPeserta($id)
    {
        // Find the peserta by ID
        $peserta = PesertaKegiatan::findOrFail($id);

        // Check if the file exists and delete it from storage
        if ($peserta->file_upload && Storage::disk('public')->exists($peserta->file_upload)) {
            Storage::disk('public')->delete($peserta->file_upload);
        }

        // Delete the peserta record
        $peserta->delete();

        // Redirect back to the peserta page with a success message
        return redirect()->route('kelolapeserta', ['id' => $peserta->kegiatan_id])->with('success', 'Peserta berhasil dihapus.');
    }
}
