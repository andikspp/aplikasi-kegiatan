<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class KelolapesertaController extends Controller
{
    public function kelolapeserta($id)
    {
        $kegiatan = Kegiatan::find($id);
        $peserta = PesertaKegiatan::where('kegiatan_id', $id)->get(); // Asumsikan tabel peserta memiliki kolom kegiatan_id
        return view('admin.menu.kelolapeserta', compact('kegiatan', 'peserta'));
    }

    public function cetakBiodata($kegiatan_id)
    {
        // Ambil data peserta berdasarkan kegiatan_id
        $pesertaList = PesertaKegiatan::where('kegiatan_id', $kegiatan_id)->get();

        // Ambil nama kegiatan dari model Kegiatan
        $kegiatan = Kegiatan::find($kegiatan_id);
        $namaKegiatan = $kegiatan ? $kegiatan->nama : 'kegiatan_tidak_diketahui';

        // Kirim data ke view untuk template PDF
        $pdf = PDF::loadView('admin.biodata.biodata', compact('pesertaList'));

        // Set nama file berdasarkan nama kegiatan
        $namaFile = 'biodata_peserta_' . str_replace(' ', '_', strtolower($namaKegiatan)) . '.pdf';
        return $pdf->download($namaFile);
    }
}
