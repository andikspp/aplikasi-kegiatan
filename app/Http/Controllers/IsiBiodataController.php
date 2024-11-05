<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IsiBiodataController extends Controller
{
    public function index()
    {
        return view('admin.menu.isibiodata');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string|max:100',
            'pendidikan_terakhir' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'pangkat_golongan' => 'nullable|string|max:100',
            'unit_kerja' => 'required|string|max:100',
            'masa_kerja' => 'nullable|string|max:100',
            'alamat_kantor' => 'required|string|max:255',
            'telp_kantor' => 'nullable|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'telp_hp' => 'nullable|string|max:20',
            'alamat_email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:20',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048', // Validasi file
        ]);

        // Simpan data ke database
        $data = $request->all();

        // Menangani upload file
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename); // Simpan file ke folder 'uploads'
            $data['file_upload'] = $filename; // Simpan nama file ke array data
        }

        \App\Models\Peserta::create($data);

        return redirect()->route('isi.biodata')->with('success', 'Data berhasil disimpan.');
    }
}