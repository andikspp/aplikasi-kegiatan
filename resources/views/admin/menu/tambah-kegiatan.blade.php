@extends('layouts.menu.layout-dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Tambah Kegiatan</h2>

    <form id="formTambahKegiatan">
        <div class="row mb-3">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected>Pilih Pokja</option>
                    <!-- Tambahkan opsi pokja di sini -->
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="namaKegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namaKegiatan" name="namaKegiatan">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tanggal Pendaftaran</label>
            <div class="col-sm-5">
                <label for="tanggalMulai">Mulai</label>
                <input type="datetime-local" class="form-control" id="tanggalMulai" name="tanggalMulai">
            </div>
            <div class="col-sm-5">
                <label for="tanggalSelesai">Selesai</label>
                <input type="datetime-local" class="form-control" id="tanggalSelesai" name="tanggalSelesai">
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggalKegiatan" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tanggalKegiatan" name="tanggalKegiatan">
            </div>
        </div>

        <div class="row mb-3">
            <label for="tempatKegiatan" class="col-sm-2 col-form-label">Tempat Kegiatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tempatKegiatan" name="tempatKegiatan">
            </div>
        </div>

        <div class="row mb-3">
            <label for="jenisKegiatan" class="col-sm-2 col-form-label">Jenis Kegiatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="jenisKegiatan" name="jenisKegiatan">
            </div>
        </div>

        <div class="row mb-3">
            <label for="linkWebMeeting" class="col-sm-2 col-form-label">Link Web Meeting</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="linkWebMeeting" name="linkWebMeeting" placeholder="Masukkan link web meeting di sini...">
            </div>
        </div>

        <div class="row mb-3">
            <label for="jumlahJP" class="col-sm-2 col-form-label">Jumlah JP</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="jumlahJP" name="jumlahJP" value="0">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Membutuhkan Mata Pelajaran?</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mataPelajaran" id="mataPelajaranYa" value="Ya">
                    <label class="form-check-label" for="mataPelajaranYa">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mataPelajaran" id="mataPelajaranTidak" value="Tidak" checked>
                    <label class="form-check-label" for="mataPelajaranTidak">Tidak</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Membutuhkan Nomor Rekening?</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="nomorRekening" id="nomorRekeningYa" value="Ya">
                    <label class="form-check-label" for="nomorRekeningYa">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="nomorRekening" id="nomorRekeningTidak" value="Tidak" checked>
                    <label class="form-check-label" for="nomorRekeningTidak">Tidak</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Membutuhkan Lokasi?</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lokasi" id="lokasiYa" value="Ya">
                    <label class="form-check-label" for="lokasiYa">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lokasi" id="lokasiTidak" value="Tidak" checked>
                    <label class="form-check-label" for="lokasiTidak">Tidak</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Membutuhkan foto presensi?</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="fotoPresensi" id="fotoPresensiYa" value="Ya">
                    <label class="form-check-label" for="fotoPresensiYa">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="fotoPresensi" id="fotoPresensiTidak" value="Tidak" checked>
                    <label class="form-check-label" for="fotoPresensiTidak">Tidak</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Menggunakan Sertifikat?</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sertifikat" id="sertifikatYa" value="Ya">
                    <label class="form-check-label" for="sertifikatYa">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sertifikat" id="sertifikatTidak" value="Tidak" checked>
                    <label class="form-check-label" for="sertifikatTidak">Tidak</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="nomorSertifikat" class="col-sm-2 col-form-label">Nomor Sertifikat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nomorSertifikat" name="nomorSertifikat">
            </div>
        </div>

        <div class="row mb-3">
            <label for="nomorSeriSertifikat" class="col-sm-2 col-form-label">Nomor Seri Sertifikat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nomorSeriSertifikat" name="nomorSeriSertifikat">
            </div>
        </div>

        <div class="row mb-3">
            <label for="pintasan" class="col-sm-2 col-form-label">*) Pintasan {nomor_peserta}</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pintasan" name="pintasan">
            </div>
        </div>

        <div class="row mb-3">
            <label for="templateSertifikat" class="col-sm-2 col-form-label">Template Sertifikat</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="templateSertifikat" name="templateSertifikat">
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggalTTDSertifikat" class="col-sm-2 col-form-label">Tanggal TTD Sertifikat</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggalTTDSertifikat" name="tanggalTTDSertifikat">
            </div>
        </div>

        <div class="row mb-3">
            <label for="peranDalamKegiatan" class="col-sm-2 col-form-label">Peran Dalam Kegiatan</label>
            <div class="col-sm-10">
                <div class="d-flex align-items-center">
                    <select class="form-select" id="peranDalamKegiatan" name="peranDalamKegiatan">
                        <option value="" selected>Pilih Peran</option>
                        <option value="Peserta">Peserta</option>
                        <!-- Tambahkan opsi peran lainnya di sini -->
                    </select>
                    <button type="button" class="btn btn-primary ms-2" id="tambahPeran">+ Tambah Peran</button>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <table class="table table-bordered" id="tabelPeran">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Peran</th>
                            <th>Nomor Rekening?</th>
                            <th>Kode Kegiatan</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Peserta</td>
                            <td>-</td>
                            <td>undefined</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger hapusPeran">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let nomorUrut = 1;

        $('#tambahPeran').click(function() {
            const peran = $('#peranDalamKegiatan').val();
            if (peran) {
                nomorUrut++;
                const newRow = `
                    <tr>
                        <td>${nomorUrut}</td>
                        <td>${peran}</td>
                        <td>-</td>
                        <td>undefined</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger hapusPeran">Hapus</button>
                        </td>
                    </tr>
                `;
                $('#tabelPeran tbody').append(newRow);
                $('#peranDalamKegiatan').val('');
            }
        });

        $(document).on('click', '.hapusPeran', function() {
            $(this).closest('tr').remove();
            updateNomorUrut();
        });

        function updateNomorUrut() {
            $('#tabelPeran tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
            nomorUrut = $('#tabelPeran tbody tr').length;
        }

        $('#formTambahKegiatan').submit(function(e) {
            e.preventDefault();
            // Di sini Anda dapat menambahkan logika untuk mengirim data formulir ke server
            console.log('Form submitted');
        });

        $('#btnBatal').click(function() {
            // Di sini Anda dapat menambahkan logika untuk membatalkan pengisian formulir
            if (confirm('Apakah Anda yakin ingin membatalkan pengisian formulir?')) {
                // Misalnya, kembali ke halaman sebelumnya atau ke dashboard
                window.history.back();
                // Atau gunakan: window.location.href = '/dashboard';
            }
        });
    });
</script>
@endpush