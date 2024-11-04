@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <!-- ... existing buttons ... -->
        </div>

        <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow">
            <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Biodata</h1>
            <div class="mb-3">
                <label for="namaLengkap" class="form-label">1. Nama Lengkap</label>
                <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan Nama Lengkap" required>
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">2. NIP (jika PNS)</label>
                <input type="text" class="form-control" id="nip" placeholder="Masukkan NIP" required>
            </div>
            <div class="mb-3">
                <label for="tempatTanggalLahir" class="form-label">3. Tempat / Tanggal Lahir</label>
                <input type="text" class="form-control" id="tempatTanggalLahir" placeholder="Masukkan Tempat / Tanggal Lahir" required>
            </div>
            <div class="mb-3">
                <label for="jenisKelamin" class="form-label">4. Jenis Kelamin</label>
                <select class="form-select" id="jenisKelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="agama" class="form-label">5. Agama</label>
                <input type="text" class="form-control" id="agama" placeholder="Masukkan Agama" required>
            </div>
            <div class="mb-3">
                <label for="pendidikanTerakhir" class="form-label">6. Pendidikan Terakhir</label>
                <input type="text" class="form-control" id="pendidikanTerakhir" placeholder="Masukkan Pendidikan Terakhir" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">7. Jabatan</label>
                <input type="text" class="form-control" id="jabatan" placeholder="Masukkan Jabatan" required>
            </div>
            <div class="mb-3">
                <label for="pangkatGolongan" class="form-label">8. Pangkat/Golongan (jika PNS)</label>
                <input type="text" class="form-control" id="pangkatGolongan" placeholder="Masukkan Pangkat/Golongan" required>
            </div>
            <div class="mb-3">
                <label for="unitKerja" class="form-label">9. Unit Kerja</label>
                <input type="text" class="form-control" id="unitKerja" placeholder="Masukkan Unit Kerja" required>
            </div>
            <div class="mb-3">
                <label for="masaKerja" class="form-label">10. Masa Kerja</label>
                <input type="text" class="form-control" id="masaKerja" placeholder="Masukkan Masa Kerja" required>
            </div>
            <div class="mb-3">
                <label for="alamatKantor" class="form-label">11. Alamat Kantor</label>
                <input type="text" class="form-control" id="alamatKantor" placeholder="Masukkan Alamat Kantor" required>
            </div>
            <div class="mb-3">
                <label for="telpKantor" class="form-label">Telp</label>
                <input type="text" class="form-control" id="telpKantor" placeholder="Masukkan Telp Kantor" required>
            </div>
            <div class="mb-3">
                <label for="alamatRumah" class="form-label">12. Alamat Rumah</label>
                <input type="text" class="form-control" id="alamatRumah" placeholder="Masukkan Alamat Rumah" required>
            </div>
            <div class="mb-3">
                <label for="telpRumah" class="form-label">Telp/HP</label>
                <input type="text" class="form-control" id="telpRumah" placeholder="Masukkan Telp/HP" required>
            </div>
            <div class="mb-3">
                <label for="alamatEmail" class="form-label">13. Alamat Email</label>
                <input type="email" class="form-control" id="alamatEmail" placeholder="Masukkan Alamat Email" required>
            </div>
            <div class="mb-3">
                <label for="npwp" class="form-label">14. NPWP</label>
                <input type="text" class="form-control" id="npwp" placeholder="Masukkan NPWP" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <!-- ... existing styles ... -->
@endsection