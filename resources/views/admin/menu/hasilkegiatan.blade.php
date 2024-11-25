@extends('layouts.menu.layout-dashboard')
@section('title', 'Kelola Kegiatan')
@section('content')
    <div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <a href="{{ route('hasilkegiatan', ['id' => $kegiatan->id]) }}" class="btn btn-primary me-2">
                <i class="fas fa-calendar"></i> Kelola Kegiatan
            </a>
            <a href="{{ route('kelolapeserta', ['id' => $kegiatan->id]) }}" class="btn btn-link me-2">
                <i class="fas fa-users"></i> Kelola Peserta
            </a>
            <a href="{{ route('kelolalainnya', ['id' => $kegiatan->id]) }}" class="btn btn-link">
                <i class="fas fa-cogs"></i> Kelola Lainnya
            </a>
        </div>

        <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow"
            action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Ubah Kegiatan</h1>

            {{-- <div class="mb-3">
                <label for="kodeKegiatan" class="form-label">Kode Kegiatan</label>
                <input type="text" class="form-control" id="kodeKegiatan" name="kodeKegiatan"
                    value="{{ $kegiatan->id }}">
            </div> --}}

            @if (auth()->user()->role !== 'superadmin')
                <input type="hidden" name="pokja_id" value="{{ $kegiatan->pokja_id }}">
            @endif

            <div class="mb-3">
                <label for="pokja_id" class="form-label">Pokja</label>
                <select class="form-select" id="pokja_id" name="pokja_id"
                    {{ auth()->user()->role !== 'superadmin' ? 'disabled' : '' }} required>
                    <option value="">Pilih Pokja</option>
                    @foreach ($pokjas as $pokja)
                        <option value="{{ $pokja->id }}" {{ $kegiatan->pokja_id == $pokja->id ? 'selected' : '' }}>
                            {{ $pokja->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $kegiatan->nama }}">
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Pendaftaran</label>
                <div class="col-sm-5">
                    <label for="tanggal_pendaftaran">Mulai</label>
                    <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                        value="{{ $kegiatan->tanggal_pendaftaran }}">
                </div>
                <div class="col-sm-5">
                    <label for="selesai_pendaftaran">Selesai</label>
                    <input type="date" class="form-control" id="selesai_pendaftaran" name="selesai_pendaftaran"
                        value="{{ $kegiatan->selesai_pendaftaran }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan"
                    value="{{ $kegiatan->tanggal_kegiatan }}">
            </div>

            <div class="mb-3">
                <label for="tempatKegiatan" class="form-label">Tempat Kegiatan</label>
                <input type="text" class="form-control" id="tempat_kegiatan" name="tempat_kegiatan"
                    value="{{ $kegiatan->tempat_kegiatan }}">
            </div>

            <div class="mb-3">
                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan <span class="text-danger">*</span></label>
                <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" required>
                    <option value="">Pilih Jenis Kegiatan</option>
                    <option value="luring">Luring</option>
                    <option value="daring">Daring</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="link_meeting" class="form-label">Link Web Meeting</label>
                <input type="text" class="form-control" id="link_meeting" name="link_meeting"
                    value="{{ $kegiatan->link_meeting }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah JP</label>
                <input type="number" class="form-control" id="jumlah_jp" name="jumlah_jp"
                    value="{{ $kegiatan->jumlah_jp }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan Mata Pelajaran?</label>
                <div>
                    <label><input type="radio" name="membutuhkan_mapel" value="ya"
                            {{ $kegiatan->membutuhkan_mapel == 'ya' ? 'checked' : '' }} style="accent-color: blue;">
                        Ya</label>
                    <label><input type="radio" name="membutuhkan_mapel" value="tidak"
                            {{ $kegiatan->membutuhkan_mapel == 'tidak' ? 'checked' : '' }} style="accent-color: blue;">
                        Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan Nomor Rekening?</label>
                <div>
                    <label><input type="radio" name="membutuhkan_nomor_rekening" value="ya"
                            {{ $kegiatan->membutuhkan_nomor_rekening == 'ya' ? 'checked' : '' }}
                            style="accent-color: blue;">
                        Ya</label>
                    <label><input type="radio" name="membutuhkan_nomor_rekening" value="tidak"
                            {{ $kegiatan->membutuhkan_nomor_rekening == 'tidak' ? 'checked' : '' }}
                            style="accent-color: blue;">
                        Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan Lokasi?</label>
                <div>
                    <label><input type="radio" name="membutuhkan_lokasi" value="ya"
                            {{ $kegiatan->membutuhkan_lokasi == 'ya' ? 'checked' : '' }} style="accent-color: blue;">
                        Ya</label>
                    <label><input type="radio" name="membutuhkan_lokasi" value="tidak"
                            {{ $kegiatan->membutuhkan_lokasi == 'tidak' ? 'checked' : '' }} style="accent-color: blue;">
                        Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Membutuhkan foto presensi?</label>
                <div>
                    <label><input type="radio" name="membutuhkan_foto_presensi" value="ya"
                            {{ $kegiatan->membutuhkan_foto_presensi == 'ya' ? 'checked' : '' }}
                            style="accent-color: blue;">
                        Ya</label>
                    <label><input type="radio" name="membutuhkan_foto_presensi" value="tidak"
                            {{ $kegiatan->membutuhkan_foto_presensi == 'tidak' ? 'checked' : '' }}
                            style="accent-color: blue;">
                        Tidak</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Menggunakan Sertifikat?</label>
                <div>
                    <label><input type="radio" name="menggunakan_sertifikat" value="ya"
                            {{ $kegiatan->menggunakan_sertifikat == 'ya' ? 'checked' : '' }} style="accent-color: blue;">
                        Ya</label>
                    <label><input type="radio" name="menggunakan_sertifikat" value="tidak"
                            {{ $kegiatan->menggunakan_sertifikat == 'tidak' ? 'checked' : '' }}
                            style="accent-color: blue;">
                        Tidak</label>
                </div>
            </div>

            <!-- Nomor Sertifikat -->
            <div class="mb-3">
                <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat (Opsional)</label>
                <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="form-control"
                    maxlength="255" value="{{ old('nomor_sertifikat', $kegiatan->nomor_sertifikat) }}">
            </div>

            <!-- Nomor Seri Sertifikat -->
            <div class="mb-3">
                <label for="nomor_seri_sertifikat" class="form-label">Nomor Seri Sertifikat (Opsional)</label>
                <input type="text" name="nomor_seri_sertifikat" id="nomor_seri_sertifikat" class="form-control"
                    maxlength="255" value="{{ old('nomor_seri_sertifikat', $kegiatan->nomor_seri_sertifikat) }}">
            </div>

            <!-- Template Sertifikat -->
            <div class="mb-3">
                <label for="template_sertifikat" class="form-label">Template Sertifikat (Opsional)</label>
                <input type="text" name="template_sertifikat" id="template_sertifikat" class="form-control"
                    maxlength="255" value="{{ old('template_sertifikat', $kegiatan->template_sertifikat) }}">
            </div>

            <!-- Tanggal TTD Sertifikat -->
            <div class="mb-3">
                <label for="tanggal_ttd_sertifikat" class="form-label">Tanggal TTD Sertifikat (Opsional)</label>
                <input type="date" name="tanggal_ttd_sertifikat" id="tanggal_ttd_sertifikat" class="form-control"
                    value="{{ old('tanggal_ttd_sertifikat', $kegiatan->tanggal_ttd_sertifikat) }}">
            </div>


            <!-- Table for editing Peran -->
            <div class="mb-3">
                <label class="form-label">Peran <span class="text-danger">*</span></label>
                <div class="d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-success ms-auto" onclick="addPeranRow()">Tambah Peran</button>
                </div>
                <table class="table table-bordered mt-3" id="peranTable">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Peran</th>
                            <th class="text-center">Jumlah Peserta</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Existing rows should be generated from the peran_kegiatan table -->
                        @foreach ($peran_kegiatan as $index => $peran)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <select name="peran[]" class="form-control text-center">
                                        <option value="">Pilih Peran</option>
                                        <option value="Peserta" {{ $peran->peran === 'Peserta' ? 'selected' : '' }}>
                                            Peserta</option>
                                        <option value="Narasumber/Fasilitator"
                                            {{ $peran->peran === 'Narasumber/Fasilitator' ? 'selected' : '' }}>
                                            Narasumber/Fasilitator</option>
                                        <option value="Pengarah" {{ $peran->peran === 'Pengarah' ? 'selected' : '' }}>
                                            Pengarah</option>
                                        <option value="Panitia" {{ $peran->peran === 'Panitia' ? 'selected' : '' }}>
                                            Panitia</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="jumlah_peserta[]" value="{{ $peran->jumlah_peserta }}"
                                        class="form-control text-center">
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-danger"
                                        onclick="deleteRow(this)">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- <div class="mb-3">
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
            </div> --}}

            <!-- Quiz/Evaluasi -->
            {{-- <div class="mb-3">
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
            </div> --}}

            <div class="row">
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('kegiatan') }}" class="btn btn-danger ms-2">Kembali</a>
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

        .btn-link {
            text-decoration: none;
            /* Menghilangkan garis bawah */
            color: #0d6efd;
            /* Warna teks */
        }
    </style>
@endsection

@push('scripts')
    <script>
        let peranCounter = {{ count($peran_kegiatan) + 1 }}; // Mulai counter setelah baris yang ada

        // Fungsi untuk menambah baris baru
        function addPeranRow() {
            const tableBody = document.querySelector("#peranTable tbody");
            const newRow = document.createElement("tr");

            newRow.innerHTML = `
        <td class="text-center">${peranCounter}</td>
        <td>
            <select name="peran[]" class="form-control text-center" required>
                <option value="">Pilih Peran</option>
                <option value="Narasumber/Fasilitator">Narasumber/Fasilitator</option>
                <option value="Pengarah">Pengarah</option>
                <option value="Panitia">Panitia</option>
                <option value="Peserta">Peserta</option>
            </select>
        </td>

        <td>
            <input type="number" name="jumlah_peserta[]" class="form-control text-center" required>
        </td>
        
        <td style="text-align: center;">
            <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Hapus</button>
        </td>
    `;

            tableBody.appendChild(newRow);
            peranCounter++;
        }

        // Function to delete a row
        function deleteRow(button) {
            const row = button.closest("tr");
            row.remove();

            // Update row numbers
            const rows = document.querySelectorAll("#peranTable tbody tr");
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
            });
            peranCounter = rows.length + 1; // Adjust counter based on remaining rows
        }


        // $(document).ready(function() {
        //     $('#formUbahKegiatan').submit(function(e) {
        //         e.preventDefault();
        //         // Di sini Anda dapat menambahkan logika untuk mengirim data formulir ke server
        //         console.log('Form submitted');
        //     });

        //     $('#btnBatal').click(function() {
        //         if (confirm('Apakah Anda yakin ingin membatalkan pengisian formulir?')) {
        //             window.history.back();
        //         }
        //     });

        //     $('#btnTambahPeran').click(function() {
        //         const peran = $('#peran').val();
        //         const link = 'https://example.com'; // Ganti dengan logika untuk mendapatkan link
        //         const kodeRekening = 'U27PD'; // Ganti dengan logika untuk mendapatkan kode rekening

        //         if (peran !== 'Pilih Peran') {
        //             const rowCount = $('#tabelPeran tr').length + 1;
        //             $('#tabelPeran').append(`
    //                 <tr>
    //                     <td>${rowCount}</td>
    //                     <td>${peran}</td>
    //                     <td><a href="${link}" target="_blank">${link}</a></td>
    //                     <td>${kodeRekening}</td>
    //                     <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
    //                 </tr>
    //             `);
        //         }
        //     });

        //     $('input[name="sertifikat"]').change(function() {
        //         if ($(this).val() === 'ya') {
        //             $('#sertifikatFields').show(); // Menampilkan field sertifikat
        //         } else {
        //             $('#sertifikatFields').hide(); // Menyembunyikan field sertifikat
        //         }
        //     });
        // });

        // function removeRow(button) {
        //     $(button).closest('tr').remove();
        // }
    </script>
@endpush
