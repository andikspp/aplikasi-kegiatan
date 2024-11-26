<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaKegiatan;
use App\Exports\PesertaExport;
use Maatwebsite\Excel\Facades\Excel;

class PesertaExportController extends Controller
{
    public function export($kegiatan_id)
    {
        // Cek apakah data peserta dengan kegiatan_id ada
        $dataPeserta = PesertaKegiatan::where('kegiatan_id', $kegiatan_id)->exists();

        if ($dataPeserta) {
            return Excel::download(new PesertaExport($kegiatan_id), 'peserta_' . $kegiatan_id . '.xlsx');
        } else {
            // Jika data tidak ditemukan, beri notifikasi atau pesan
            return redirect()->back()->with('error', 'Data peserta tidak ditemukan untuk kegiatan ini.');
        }
    }
}
