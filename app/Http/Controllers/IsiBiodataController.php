<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class IsiBiodataController extends Controller
{
    public function index($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('user.biodata.isibiodata', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $pesertaSudahDaftar = Peserta::where('user_id', $request->user_id)
            ->where('kegiatan_id', $request->kegiatan_id)
            ->first();

        if ($pesertaSudahDaftar) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar pada kegiatan ini.');
        }

        // Validate the input fields
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
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

        // Handle the file upload if there is one
        if ($request->hasFile('file_upload')) {
            // Simpan file di storage/app/public/uploads
            $filePath = $request->file('file_upload')->store('public/uploads');
            // Hapus "public/" dari path untuk menyimpan hanya path relatif
            $filePath = str_replace('public/', '', $filePath);
        } else {
            $filePath = null;
        }

        // Store the Peserta data using create
        Peserta::create([
            'user_id' => $request->user_id,
            'kegiatan_id' => $request->kegiatan_id, // Getting the kegiatan ID from the form
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => Carbon::parse($request->tanggal_lahir)->format('Y-m-d'), // Parse and format date
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

        // Redirect or return a response
        return redirect()->route('user.kegiatan')->with('success', 'Data anda berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
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

        // Find the Peserta record to update
        $peserta = Peserta::findOrFail($id);

        // Handle the file upload if there is one
        if ($request->hasFile('file_upload')) {
            // Delete the old file from storage if it exists
            if ($peserta->file_upload) {
                Storage::delete('public/' . $peserta->file_upload);
            }

            // Save the new file
            $filePath = $request->file('file_upload')->store('public/uploads');
            // Remove the 'public/' prefix
            $filePath = str_replace('public/', '', $filePath);
        } else {
            // Keep the existing file if no new file is uploaded
            $filePath = $peserta->file_upload;
        }

        // Update the Peserta data
        $peserta->update([
            'user_id' => $request->user_id,
            'kegiatan_id' => $request->kegiatan_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => Carbon::parse($request->tanggal_lahir)->format('Y-m-d'),
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

        // Redirect or return a response
        return redirect()->route('user.kegiatan')->with('success', 'Data peserta berhasil diperbarui.');
    }
}
