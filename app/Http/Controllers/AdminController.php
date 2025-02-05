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
        $peserta = PesertaKegiatan::findOrFail($id);
        $kegiatan = Kegiatan::find($peserta->kegiatan_id);

        // Validasi data pendaftaran
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string|max:100',
            'pendidikan_terakhir' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'pangkat_golongan' => 'nullable|string|max:100',
            'unit_kerja' => 'required|string|max:100',
            'alamat_kantor' => 'required|string|max:255',
            'telp_kantor' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'telp_rumah' => 'required|string|max:20',
            'alamat_email' => 'required|email|max:255',
            'npwp' => 'required|string|max:20',
            'nomor_rekening' => $kegiatan->membutuhkan_nomor_rekening === 'ya' ? 'required|numeric' : 'nullable',
            'peran' => 'required|string',
            'surat_tugas' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'tiket' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'boarding_pass' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'bukti_perjalanan' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'sppd' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'signature' => 'nullable|string',
        ]);

        // Update signature jika ada
        if ($request->signature) {
            $signatureData = $request->signature;
            $signatureName = 'signature_' . time() . '.png'; // Nama file unik
            $signaturePath = 'public/ttd/' . $signatureName; // Path file di storage

            // Decode base64 dan simpan sebagai file
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));
            Storage::put($signaturePath, $image); // Simpan file di storage/app/public/ttd

            // Simpan path relatif ke database
            $peserta->signature = 'ttd/' . $signatureName;
        }

        // Update semua field lainnya
        $peserta->update([
            'kegiatan_id' => $request->kegiatan_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jabatan' => $request->jabatan,
            'pangkat_golongan' => $request->pangkat_golongan,
            'unit_kerja' => $request->unit_kerja,
            'alamat_kantor' => $request->alamat_kantor,
            'telp_kantor' => $request->telp_kantor,
            'alamat_rumah' => $request->alamat_rumah,
            'telp_rumah' => $request->telp_rumah,
            'alamat_email' => $request->alamat_email,
            'npwp' => $request->npwp,
            'nomor_rekening' => $request->nomor_rekening,
            'peran' => $request->peran,
        ]);

        // Update file jika ada
        $fileColumns = ['surat_tugas', 'tiket', 'boarding_pass', 'bukti_perjalanan', 'sppd'];

        foreach ($fileColumns as $column) {
            if ($request->hasFile($column)) {
                // Hapus file lama jika ada
                if ($peserta->$column) {
                    Storage::delete('public/' . $peserta->$column);
                }

                $filePath = $request->file($column)->store('public/uploads');
                $filePath = str_replace('public/', '', $filePath);
                $peserta->$column = $filePath;
            }
        }

        $peserta->save();

        return redirect()->route('kelolapeserta', ['id' => $peserta->kegiatan_id])
            ->with('success', 'Data peserta berhasil diperbarui!');
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
