<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Peserta;

class KelolapesertaController extends Controller
{
    public function kelolapeserta($id)
    {
        $kegiatan = Kegiatan::find($id);
        $peserta = Peserta::where('kegiatan_id', $id)->get(); // Asumsikan tabel peserta memiliki kolom kegiatan_id
        return view('admin.menu.kelolapeserta', compact('kegiatan', 'peserta'));
    }
}
