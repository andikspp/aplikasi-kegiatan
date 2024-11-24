@extends('layouts.menu.layout-dashboard')
@section('title', 'Tambah Kegiatan')
@section('content')
    <div class="container mt-5">
        <h2>Tambah Kegiatan</h2>
        <form action="{{ route('kegiatan.store') }}" method="POST" class="shadow p-4 bg-light rounded form-background"
            id="formKegiatan">
            @csrf

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">Pokja <span class="text-danger">*</span></label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">Pilih Role</option>
                    <option value="Tata Kelola">Tata Kelola</option>
                    <option value="Kemitraan">Kemitraan</option>
                    <option value="Publikasi">Publikasi</option>
                    <option value="Pembelajaran">Pembelajaran</option>
                    <option value="PAUD HI">PAUD HI</option>
                    <option value="Tata Usaha">Tata Usaha</option>
                </select>
            </div>

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control" required maxlength="255">
            </div>

            <!-- Tanggal Pendaftaran -->
            <div class="mb-3">
                <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran <span
                        class="text-danger">*</span></label>
                <input type="date" name="tanggal_pendaftaran" id="tanggal_pendaftaran" class="form-control" required>
            </div>

            <!-- Selesai Pendaftaran -->
            <div class="mb-3">
                <label for="selesai_pendaftaran" class="form-label">Selesai Pendaftaran <span
                        class="text-danger">*</span></label>
                <input type="date" name="selesai_pendaftaran" id="selesai_pendaftaran" class="form-control" required>
            </div>

            <!-- Tanggal Kegiatan -->
            <div class="mb-3">
                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control" required>
            </div>

            <!-- Tempat Kegiatan -->
            <div class="mb-3">
                <label for="tempat_kegiatan" class="form-label">Tempat Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="tempat_kegiatan" id="tempat_kegiatan" class="form-control" required
                    maxlength="255">
            </div>

            <!-- Jenis Kegiatan -->
            <div class="mb-3">
                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" required
                    maxlength="255">
            </div>

            <!-- Link Meeting -->
            <div class="mb-3">
                <label for="link_meeting" class="form-label">Link Meeting (Opsional)</label>
                <input type="url" name="link_meeting" id="link_meeting" class="form-control">
            </div>

            <!-- Jumlah JP -->
            <div class="mb-3">
                <label for="jumlah_jp" class="form-label">Jumlah JP <span class="text-danger">*</span></label>
                <input type="number" name="jumlah_jp" id="jumlah_jp" class="form-control" required>
            </div>

            <!-- Membutuhkan Mapel -->
            <div class="mb-3">
                <label class="form-label">Membutuhkan Mapel <span class="text-danger">*</span></label>
                <select name="membutuhkan_mapel" class="form-control" required>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            <!-- Jumlah Peserta -->
            <div class="mb-3">
                <label for="jumlah_peserta" class="form-label">Jumlah Peserta <span class="text-danger">*</span></label>
                <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" required>
            </div>

            <!-- Membutuhkan Lokasi -->
            <div class="mb-3">
                <label class="form-label">Membutuhkan Lokasi <span class="text-danger">*</span></label>
                <select name="membutuhkan_lokasi" class="form-control" required>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            <!-- Membutuhkan Foto Presensi -->
            <div class="mb-3">
                <label class="form-label">Membutuhkan Foto Presensi <span class="text-danger">*</span></label>
                <select name="membutuhkan_foto_presensi" class="form-control" required>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            <!-- Menggunakan Sertifikat -->
            <div class="mb-3">
                <label class="form-label">Menggunakan Sertifikat <span class="text-danger">*</span></label>
                <select name="menggunakan_sertifikat" class="form-control" required>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            <!-- Nomor Sertifikat -->
            <div class="mb-3">
                <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat (Opsional)</label>
                <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="form-control"
                    maxlength="255">
            </div>

            <!-- Nomor Seri Sertifikat -->
            <div class="mb-3">
                <label for="nomor_seri_sertifikat" class="form-label">Nomor Seri Sertifikat (Opsional)</label>
                <input type="text" name="nomor_seri_sertifikat" id="nomor_seri_sertifikat" class="form-control"
                    maxlength="255">
            </div>

            <!-- Template Sertifikat -->
            <div class="mb-3">
                <label for="template_sertifikat" class="form-label">Template Sertifikat (Opsional)</label>
                <input type="text" name="template_sertifikat" id="template_sertifikat" class="form-control"
                    maxlength="255">
            </div>

            <!-- Tanggal TTD Sertifikat -->
            <div class="mb-3">
                <label for="tanggal_ttd_sertifikat" class="form-label">Tanggal TTD Sertifikat (Opsional)</label>
                <input type="date" name="tanggal_ttd_sertifikat" id="tanggal_ttd_sertifikat" class="form-control">
            </div>

            <!-- Table for adding Peran -->
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
                            <th class="text-center">Jumlah Peserta</th> <!-- Diubah dari Nomor Rekening -->
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('kegiatan') }}" class="btn btn-danger ms-2">Kembali</a>
        </form>
    </div>

    <style>
        .form-label {
            font-weight: bold;
        }

        .form-background {
            background-color: #f7f9fc;
            /* Soft background color */
            border: 1px solid #e3e6f0;
            /* Light border for subtle framing */
        }
    </style>
@endsection

@push('scripts')
    <script>
        let peranCounter = 1;

        // Function to add a new row
        function addPeranRow() {
            const tableBody = document.querySelector("#peranTable tbody");
            const newRow = document.createElement("tr");

            newRow.innerHTML = `
        <td class="text-center">${peranCounter}</td>
        <td>
            <select name="peran[]" class="form-control text-center" required>
                <option value="">Pilih Peran</option>
                <option value="Peserta">Peserta</option>
                <option value="Narasumber">Narasumber</option>
                <option value="Fasilitator">Fasilitator</option>
                <option value="Panitia">Panitia</option>
            </select>
        </td>
        <td>
            <input type="number" name="jumlah_peserta[]" class="form-control text-center" required>
        </td>
        <td>
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
            peranCounter = rows.length + 1;
        }
    </script>
@endpush