@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <a href="{{ route('hasilkegiatan') }}" class="btn btn-primary me-2">
                <i class="fas fa-calendar"></i> Kelola Kegiatan
            </a>
            <a href="{{ route('kelolapeserta') }}" class="btn btn-link">
                <i class="fas fa-users"></i> Kelola Peserta
            </a>
            <a href="{{ route('kelolalainnya') }}" class="btn btn-link">
                <i class="fas fa-cogs"></i> Kelola Lainnya
            </a>
        </div>

        <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow">
        <h1 class="mb-4" style="font-size: larger;">Ubah Kegiatan</h1>
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

            <!-- Tambahan pertanyaan di bawah link web meeting -->
            <div class="mb-3">
                <label class="form-label">Jumlah JP</label>
                <input type="number" class="form-control" id="jumlahJP" name="jumlahJP" value="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan Mata Pelajaran?</label>
                <div>
                    <label><input type="radio" name="mataPelajaran" value="ya"> Ya</label>
                    <label><input type="radio" name="mataPelajaran" value="tidak"> Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan Nomor Rekening?</label>
                <div>
                    <label><input type="radio" name="nomorRekening" value="ya"> Ya</label>
                    <label><input type="radio" name="nomorRekening" value="tidak"> Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan Lokasi?</label>
                <div>
                    <label><input type="radio" name="lokasi" value="ya"> Ya</label>
                    <label><input type="radio" name="lokasi" value="tidak"> Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan foto presensi?</label>
                <div>
                    <label><input type="radio" name="fotoPresensi" value="ya"> Ya</label>
                    <label><input type="radio" name="fotoPresensi" value="tidak"> Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Menggunakan Sertifikat?</label>
                <div>
                    <label><input type="radio" name="sertifikat" value="ya"> Ya</label>
                    <label><input type="radio" name="sertifikat" value="tidak"> Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="peran" class="form-label">Peran Dalam Kegiatan</label>
                <div class="input-group">
                    <select class="form-select" id="peran" name="peran">
                        <option selected>Pilih Peran</option>
                        <option value="peserta">Peserta</option>
                        <!-- Tambahkan opsi peran lainnya di sini -->
                    </select>
                    <button class="btn btn-outline-primary" type="button" id="btnTambahPeran">+ Tambah Peran</button>
                </div>
                <small class="form-text text-muted">(default: Peserta)</small>
            </div>

            <div class="mb-3">
                <label for="peran" class="form-label">Peran Dalam Kegiatan</label>
                <div class="input-group">
                    <select class="form-select" id="peran" name="peran">
                        <option selected>Pilih Peran</option>
                        <option value="peserta">Peserta</option>
                        <!-- Tambahkan opsi peran lainnya di sini -->
                    </select>
                    <button class="btn btn-outline-primary" type="button" id="btnTambahPeran">+ Tambah Peran</button>
                </div>
                <small class="form-text text-muted">(default: Peserta)</small>
            </div>

            <!-- Tabel untuk menampilkan peran yang telah ditambahkan -->
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Peran</th>
                        <th>Link</th>
                        <th>Kode Rekening?</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelPeran">
                    <!-- Baris peran akan ditambahkan di sini melalui JavaScript -->
                </tbody>
            </table>

            <div class="mb-3">
                <h5>Tautan Presensi</h5>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari</th>
                            <th>Tautan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPresensi">
                        <!-- Baris presensi akan ditambahkan di sini melalui JavaScript -->
                    </tbody>
                </table>
                <button class="btn btn-outline-primary" type="button" id="btnTambahPresensi">+ Tambah Presensi</button>
            </div>

            <!-- Quiz/Evaluasi -->
            <div class="mb-3">
                <h5>Quiz/Evaluasi</h5>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Quiz/Evaluasi</th>
                            <th>Tautan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelQuiz">
                        <!-- Baris quiz akan ditambahkan di sini melalui JavaScript -->
                    </tbody>
                </table>
                <button class="btn btn-outline-primary" type="button" id="btnTambahQuiz">+ Tambah Quiz</button>
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
        .bg-light {
            background-color: #f8f9fa !important;
        }
        .rounded {
            border-radius: 0.5rem;
        }
        .shadow {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
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

        $('#btnTambahPeran').click(function() {
            const peran = $('#peran').val();
            const link = 'https://example.com'; // Ganti dengan logika untuk mendapatkan link
            const kodeRekening = 'U27PD'; // Ganti dengan logika untuk mendapatkan kode rekening

            if (peran !== 'Pilih Peran') {
                const rowCount = $('#tabelPeran tr').length + 1;
                $('#tabelPeran').append(`
                    <tr>
                        <td>${rowCount}</td>
                        <td>${peran}</td>
                        <td><a href="${link}" target="_blank">${link}</a></td>
                        <td>${kodeRekening}</td>
                        <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                    </tr>
                `);
            }
        });

        function removeRow(button) {
            $(button).closest('tr').remove();
        }
    </script>
@endpush