<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\PeranKegiatan;

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
    public function update(Request $request, $id)
    {
        // dd($request->all());
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

        // Cari kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Update data kegiatan
        $kegiatan->update([
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

        // Ambil data peran dan nomor rekening dari form
        $peranData = $request->input('peran');
        $nomorRekeningData = $request->input('nomor_rekening');

        // Hapus semua peran terkait kegiatan ini sebelum menambahkan ulang
        PeranKegiatan::where('id_kegiatan', $kegiatan->id)->delete();

        // Tambahkan data peran baru
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
}
