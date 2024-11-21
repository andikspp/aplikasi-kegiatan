<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\PeranKegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;



class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validasi data kegiatan
        $request->validate([
            'pokja_id' => 'required|exists:pokjas,id',
            'nama' => 'required|string|max:255',
            'tanggal_pendaftaran' => 'required|date',
            'selesai_pendaftaran' => 'required|date',
            'tanggal_kegiatan' => 'required|date',
            'tempat_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'jumlah_jp' => 'required|numeric',
            'membutuhkan_mapel' => 'required|in:ya,tidak',
            'membutuhkan_nomor_rekening' => 'required|in:ya,tidak',
            'membutuhkan_lokasi' => 'required|in:ya,tidak',
            'membutuhkan_foto_presensi' => 'required|in:ya,tidak',
            'menggunakan_sertifikat' => 'required|in:ya,tidak',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'nomor_seri_sertifikat' => 'nullable|string|max:255',
            'template_sertifikat' => 'nullable|string|max:255',
            'tanggal_ttd_sertifikat' => 'nullable|date',
        ]);


        // Simpan ke tabel kegiatans
        $kegiatan = Kegiatan::create([
            'pokja_id' => $request->pokja_id,
            'nama' => $request->nama,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'selesai_pendaftaran' => $request->selesai_pendaftaran,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'tempat_kegiatan' => $request->tempat_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'jumlah_jp' => $request->jumlah_jp,
            'membutuhkan_mapel' => $request->membutuhkan_mapel,
            'membutuhkan_nomor_rekening' => $request->membutuhkan_nomor_rekening,
            'membutuhkan_lokasi' => $request->membutuhkan_lokasi,
            'membutuhkan_foto_presensi' => $request->membutuhkan_foto_presensi,
            'menggunakan_sertifikat' => $request->menggunakan_sertifikat,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'nomor_seri_sertifikat' => $request->nomor_seri_sertifikat,
            'template_sertifikat' => $request->template_sertifikat,
            'tanggal_ttd_sertifikat' => $request->tanggal_ttd_sertifikat,
        ]);

        $peranData = $request->input('peran'); // Ambil data peran dari form
        $nomorRekeningData = $request->input('nomor_rekening');

        // Cek apakah ada data peran
        if (is_array($peranData) && count($peranData) > 0) {
            foreach ($peranData as $key => $peran) {
                // Simpan setiap peran dan nomor rekening yang sesuai
                PeranKegiatan::create([
                    'id_kegiatan' => $kegiatan->id, // Ambil id kegiatan yang baru dibuat
                    'peran' => $peran,
                    'nomor_rekening' => $nomorRekeningData[$key] ?? null, // Ambil nomor rekening yang sesuai
                ]);
            }
        }

        return redirect()->route('kegiatan')->with('success', 'Kegiatan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::find($id); // Ganti dengan logika yang sesuai untuk mendapatkan kegiatan
        return view('admin.menu.kelolapeserta', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_pendaftaran' => 'required|date',
            'selesai_pendaftaran' => 'required|date',
            'tanggal_kegiatan' => 'required|date',
            'tempat_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'jumlah_jp' => 'required|numeric',
            'membutuhkan_mapel' => 'required|in:ya,tidak',
            'membutuhkan_nomor_rekening' => 'required|in:ya,tidak',
            'membutuhkan_lokasi' => 'required|in:ya,tidak',
            'membutuhkan_foto_presensi' => 'required|in:ya,tidak',
            'menggunakan_sertifikat' => 'required|in:ya,tidak',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'nomor_seri_sertifikat' => 'nullable|string|max:255',
            'template_sertifikat' => 'nullable|string|max:255',
            'tanggal_ttd_sertifikat' => 'nullable|date',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update([
            'role' => $request->role,
            'nama' => $request->nama,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'selesai_pendaftaran' => $request->selesai_pendaftaran,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'tempat_kegiatan' => $request->tempat_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'jumlah_jp' => $request->jumlah_jp,
            'membutuhkan_mapel' => $request->membutuhkan_mapel,
            'membutuhkan_nomor_rekening' => $request->membutuhkan_nomor_rekening,
            'membutuhkan_lokasi' => $request->membutuhkan_lokasi,
            'membutuhkan_foto_presensi' => $request->membutuhkan_foto_presensi,
            'menggunakan_sertifikat' => $request->menggunakan_sertifikat,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'nomor_seri_sertifikat' => $request->nomor_seri_sertifikat,
            'template_sertifikat' => $request->template_sertifikat,
            'tanggal_ttd_sertifikat' => $request->tanggal_ttd_sertifikat,
        ]);

        $peranData = $request->input('peran');
        $nomorRekeningData = $request->input('nomor_rekening');

        PeranKegiatan::where('id_kegiatan', $id)->delete();

        if (is_array($peranData) && count($peranData) > 0) {
            foreach ($peranData as $key => $peran) {
                PeranKegiatan::create([
                    'id_kegiatan' => $kegiatan->id,
                    'peran' => $peran,
                    'nomor_rekening' => $nomorRekeningData[$key] ?? null,
                ]);
            }
        }

        return redirect()->route('kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        PeranKegiatan::where('id_kegiatan', $kegiatan->id)->delete();

        $kegiatan->delete();

        return redirect()->route('kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }

    /**
     * Menampilkan detail kegiatan
     */
    public function detailKegiatan(string $id)
    {
        $kegiatan = Kegiatan::with('pokja')->find($id);

        if (!$kegiatan) {
            return view('user.kegiatan.notfound');
        }

        return view('user.kegiatan.detail', compact('kegiatan'));
    }

    /**
     *  Menampilkan form untuk mendaftar kegiatan
     */
    public function formKegiatan(string $id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return view('user.kegiatan.notfound');
        }

        if ($kegiatan->selesai_pendaftaran < Carbon::now()) {
            return redirect()->route('kegiatan.show', ['id' => $id])->with('error', 'Pendaftaran kegiatan telah ditutup.');
        }

        if ($kegiatan->mulai_pendaftaran > Carbon::now()) {
            return redirect()->route('kegiatan.show', ['id' => $id])->with('error', 'Pendaftaran kegiatan belum dibuka.');
        }

        // return $kegiatan;
        return view('user.kegiatan.form', compact('kegiatan', 'id'));
    }

    /**
     *  Menyimpan data pendaftaran kegiatan
     */
    public function daftarKegiatan(Request $request)
    {
        $pesertaSudahDaftar = PesertaKegiatan::where('nip', $request->nip)->where('kegiatan_id', $request->kegiatan_id)->first();

        if ($pesertaSudahDaftar) {
            return redirect()->back()->with('error', 'Peserta sudah terdaftar pada kegiatan ini.');
        }

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
            'masa_kerja' => 'required|string|max:100',
            'alamat_kantor' => 'required|string|max:255',
            'telp_kantor' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'telp_rumah' => 'required|string|max:20',
            'alamat_email' => 'required|email|max:255',
            'npwp' => 'required|string|max:20',
            'peran' => 'required|string',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        if ($request->hasFile('file_upload')) {
            // Simpan file di storage/app/public/uploads
            $filePath = $request->file('file_upload')->store('public/uploads');
            // Hapus "public/" dari path untuk menyimpan hanya path relatif
            $filePath = str_replace('public/', '', $filePath);
        } else {
            $filePath = null;
        }

        PesertaKegiatan::create([
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
            'masa_kerja' => $request->masa_kerja,
            'alamat_kantor' => $request->alamat_kantor,
            'telp_kantor' => $request->telp_kantor,
            'alamat_rumah' => $request->alamat_rumah,
            'telp_rumah' => $request->telp_rumah,
            'alamat_email' => $request->alamat_email,
            'npwp' => $request->npwp,
            'peran' => $request->peran,
            'file_upload' => $filePath,
        ]);

        return redirect()->route('kegiatan.show', ['id' => $request->kegiatan_id])->with('success', 'Pendaftaran kegiatan berhasil!');
    }
}
