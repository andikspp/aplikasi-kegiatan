@extends('layouts.default')

@section('title', 'Daftar Kegiatan')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-custom">
                    <h3 class="text-center text-white my-2">Daftar Kegiatan {{ $kegiatan->nama }}</h3>
                </div>

                <div class="card-body m-3">

                    <form action="{{ route('kegiatan.daftar.store', ['id' => $id]) }}
                    " method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="{{ $kegiatan->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Nama Lengkap</strong>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        value="" required>
                                    @error('nama_lengkap')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>NIP (jika PNS)</strong>
                                    <input type="text" class="form-control" id="nip" name="nip" value="" required>
                                    @error('nip')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @error('nip')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Tempat Lahir</strong>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" required>
                                    @error('tempat_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Tanggal Lahir</strong>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        required>
                                    @error('tanggal_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Jenis Kelamin</strong>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Agama</strong>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        placeholder="Masukkan Agama" required>
                                    @error('agama')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Pendidikan Terakhir</strong>
                                    <input type="text" class="form-control" id="pendidikan_terakhir"
                                        name="pendidikan_terakhir" placeholder="Masukkan Pendidikan Terakhir" required>
                                    @error('pendidikan_terakhir')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Jabatan</strong>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        placeholder="Masukkan Jabatan" required>
                                    @error('jabatan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Pangkat/Golongan</strong>
                                    <input type="text" class="form-control" id="pangkat_golongan"
                                        name="pangkat_golongan" placeholder="Masukkan Pangkat/Golongan" required>
                                    @error('pangkat_golongan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Unit Kerja</strong>
                                    <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"
                                        placeholder="Masukkan Unit Kerja" required>
                                    @error('unit_kerja')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Masa Kerja</strong>
                                    <input type="text" class="form-control" id="masa_kerja" name="masa_kerja"
                                        placeholder="Masukkan Masa Kerja" required>
                                    @error('masa_kerja')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Alamat Kantor</strong>
                                    <input type="text" class="form-control" id="alamat_kantor" name="alamat_kantor"
                                        placeholder="Masukkan Alamat Kantor" required>
                                    @error('alamat_kantor')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Telp Kantor</strong>
                                    <input type="text" class="form-control" id="telp_kantor" name="telp_kantor"
                                        placeholder="Masukkan Telp Kantor" required>
                                    @error('telp_kantor')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Alamat Rumah</strong>
                                    <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"
                                        placeholder="Masukkan Alamat Rumah" required>
                                    @error('alamat_rumah')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Telp/HP</strong>
                                    <input type="text" class="form-control" id="telp_rumah" name="telp_rumah"
                                        placeholder="Masukkan Telp/HP" required>
                                    @error('telp_rumah')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Alamat Email</strong>
                                    <input type="email" class="form-control" id="alamat_email" name="alamat_email"
                                        value="" required>
                                    @error('alamat_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>NPWP</strong>
                                    <input type="text" class="form-control" id="npwp" name="npwp"
                                        placeholder="Masukkan NPWP" required>
                                    @error('npwp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-box">
                                    <strong>Peran</strong>
                                    <select class="form-select" id="peran" name="peran" required>
                                        <option value="">Pilih Peran</option>
                                        <option value="Peserta">Peserta</option>
                                        <option value="Narasumber">Narasumber</option>
                                        <option value="Fasilitator">Fasilitator</option>
                                        <option value="Panitia">Panitia</option>
                                    </select>
                                    @error('peran')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="date-box">
                                <strong>Upload File</strong>
                                <input type="file" class="form-control" id="fileUpload" name="file_upload"
                                    accept=".pdf,.doc,.docx,.jpg,.png">
                                <small class="text-muted">Surat Tugas, Bukti Perjalanan, Tiket, Boarding Pass,
                                    SPPD</small>
                                @error('file_upload')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-4 d-flex flex-column align-items-center">
                            <button type="submit" class="daftar-btn w-50 mb-3">
                                Daftar
                            </button>
                            <a href="{{ route('kegiatan.daftar', $kegiatan->id) }}"
                                class="btn btn-sm btn-outline-danger" style="width: 25%%;">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #f5f7ff;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .date-box {
        background: #f8faff;
        border: 1px solid rgba(103, 126, 234, 0.1);
        border-radius: 12px;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }

    .date-box strong {
        display: block;
        color: #4b5563;
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .date-box input,
    .date-box select {
        border: 1px solid #e0e6ed;
        border-radius: 8px;
    }

    .daftar-btn {
        background-color: #0090D4;
        border: none;
        padding: 1rem 2.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 12px;
        transition: all 0.3s ease;
        color: #ffffff;
        font-size: 1.1rem;
        box-shadow: 0 4px 6px rgba(132, 250, 176, 0.2);
    }

    .daftar-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(132, 250, 176, 0.3);
    }
</style>
@endsection