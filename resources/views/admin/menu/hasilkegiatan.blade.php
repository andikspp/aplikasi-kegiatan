@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <a href="{{ route('hasilkegiatan') }}" class="btn btn-primary me-2">Kelola Kegiatan</a>
            <a href="{{ route('kelolapeserta') }}" class="btn btn-link">Kelola Peserta</a>
            <a href="{{ route('kelolalainnya') }}" class="btn btn-link">Kelola Lainnya</a>
        </div>

        <div class="d-flex mb-4 bg-light p-3">
        <h2 class="mb-4">Ubah Kegiatan</h2>

        <form id="formUbahKegiatan">
            <div class="mb-3">
                <label for="kodeKegiatan" class="form-label">Kode Kegiatan</label>
                <input type="text" class="form-control" id="kodeKegiatan" name="kodeKegiatan" value="V32X7" readonly>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role">
                    <option selected>PPPK</option>
                    <!-- Tambahkan opsi pokja di sini -->
                </select>
            </div>

            <div class="mb-3">
                <label for="namaKegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control" id="namaKegiatan" name="namaKegiatan"
                    value="Rapat Koordinasi Pengelolaan Kinerja Guru dan Kepala Sekolah Bagi PIC Dinas Pendidikan Region 1">
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Pendaftaran</label>
                <div class="col-sm-5">
                    <label for="tanggalMulai">Mulai</label>
                    <input type="datetime-local" class="form-control" id="tanggalMulai" name="tanggalMulai"
                        value="2024-07-10T12:00">
                </div>
                <div class="col-sm-5">
                    <label for="tanggalSelesai">Selesai</label>
                    <input type="datetime-local" class="form-control" id="tanggalSelesai" name="tanggalSelesai"
                        value="2024-10-18T12:00">
                </div>
            </div>

            <div class="mb-3">
                <label for="tanggalKegiatan" class="form-label">Tanggal Kegiatan</label>
                <input type="text" class="form-control" id="tanggalKegiatan" name="tanggalKegiatan"
                    value="16 s.d. 18 Oktober 2024">
            </div>

            <!-- Tambahan baru di bawah Tanggal Kegiatan -->
            <div class="mb-3">
                <label for="tempatKegiatan" class="form-label">Tempat Kegiatan</label>
                <input type="text" class="form-control" id="tempatKegiatan" name="tempatKegiatan"
                    value="Surabaya, Jawa Timur">
            </div>

            <div class="mb-3">
                <label for="jenisKegiatan" class="form-label">Jenis Kegiatan</label>
                <input type="text" class="form-control" id="jenisKegiatan" name="jenisKegiatan" value="Luring">
            </div>

            <div class="mb-3">
                <label for="linkWebMeeting" class="form-label">Link Web Meeting</label>
                <textarea class="form-control" id="linkWebMeeting" name="linkWebMeeting" rows="3"></textarea>
            </div>

            <div class="row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary ms-2" id="btnBatal">Batal</button>
                </div>
            </div>
        </form>
    </div>

    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#formUbahKegiatan').submit(function(e) {
            e.preventDefault();
            // Di sini Anda dapat menambahkan logika untuk mengirim data formulir ke server
            console.log('Form submitted');
        });

        $('#btnBatal').click(function() {
            if (confirm('Apakah Anda yakin ingin membatalkan pengisian formulir?')) {
                window.history.back();
            }
        });
    </script>
@endpush