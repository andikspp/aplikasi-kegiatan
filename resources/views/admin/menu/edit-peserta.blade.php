@extends('layouts.menu.layout-dashboard')
@section('title', 'Kelola Kegiatan')

@section('content')
    <div class="container my-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom">
                        <h3 class="text-center text-white my-2">Edit Peserta Kegiatan {{ $kegiatan->nama }}</h3>
                    </div>

                    <div class="card-body m-3">
                        <form action="{{ route('kegiatan.update', ['id' => $kegiatan->id]) }}" method="POST"
                            enctype="multipart/form-data" id="formPendaftaran">
                            @csrf
                            @method('PUT') <!-- Gunakan method PUT untuk update -->

                            <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="{{ $kegiatan->id }}">

                            <!-- Form fields (sama seperti halaman pendaftaran, tapi dengan nilai default) -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Nama Lengkap</strong>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            value="{{ $peserta->nama_lengkap }}" required>
                                        @error('nama_lengkap')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>NIP (Jika PNS)/NIK (Non PNS)</strong>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            value="{{ $peserta->nip }}" required pattern="[0-9]*"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" onblur="checkNIP()">
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
                                                value="{{ $peserta->tempat_lahir }}" placeholder="Masukkan Tempat Lahir"
                                                required>
                                            @error('tempat_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Tanggal Lahir</strong>
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir" value="{{ $peserta->tanggal_lahir }}" required>
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
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin', $peserta->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin', $peserta->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
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
                                                placeholder="Masukkan Agama" value="{{ $peserta->agama }}" required>
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
                                                name="pendidikan_terakhir" value="{{ $peserta->pendidikan_terakhir }}"
                                                placeholder="Masukkan Pendidikan Terakhir" required>
                                            @error('pendidikan_terakhir')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Jabatan</strong>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                                value="{{ $peserta->jabatan }}" placeholder="Masukkan Jabatan" required>
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
                                                name="pangkat_golongan" value="{{ $peserta->pangkat_golongan }}"
                                                placeholder="Masukkan Pangkat/Golongan">
                                            @error('pangkat_golongan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Unit Kerja</strong>
                                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"
                                                placeholder="Masukkan Unit Kerja" value="{{ $peserta->unit_kerja }}"
                                                required>
                                            @error('unit_kerja')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Alamat Kantor</strong>
                                            <input type="text" class="form-control" id="alamat_kantor"
                                                name="alamat_kantor" value="{{ $peserta->alamat_kantor }}"
                                                placeholder="Masukkan Alamat Kantor" required>
                                            @error('alamat_kantor')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Telp Kantor</strong>
                                            <input type="text" class="form-control" id="telp_kantor"
                                                name="telp_kantor" value="{{ $peserta->telp_kantor }}"
                                                placeholder="Masukkan Telp Kantor" required
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            @error('telp_kantor')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Alamat Rumah</strong>
                                            <input type="text" class="form-control" id="alamat_rumah"
                                                name="alamat_rumah" placeholder="Masukkan Alamat Rumah"
                                                value="{{ $peserta->alamat_rumah }}" required>
                                            @error('alamat_rumah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Telp/HP</strong>
                                            <input type="number" class="form-control" id="telp_rumah" name="telp_rumah"
                                                placeholder="Masukkan Telp/HP" value="{{ $peserta->telp_rumah }}"
                                                required>
                                            @error('telp_rumah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Alamat Email</strong>
                                            <input type="email" class="form-control" id="alamat_email"
                                                name="alamat_email" value="{{ $peserta->alamat_email }}" required>
                                            @error('alamat_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>NPWP</strong>
                                            <input type="text" class="form-control" id="npwp" name="npwp"
                                                placeholder="Masukkan NPWP" value="{{ $peserta->npwp }}" required>
                                            @error('npwp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if ($kegiatan->membutuhkan_nomor_rekening === 'ya')
                                    <div class="date-box">
                                        <strong>Nomor Rekening</strong>
                                        <input type="number" class="form-control" id="nomor_rekening"
                                            name="nomor_rekening" value="{{ $peserta->nomor_rekening }}" required>
                                    </div>
                                @endif

                                <div class="date-box">
                                    <strong>Peran</strong>
                                    <select class="form-select" id="peran" name="peran" required>
                                        <option value="" disabled selected>Pilih Peran</option>
                                        @foreach ($peranList as $peran)
                                            <option value="{{ $peran }}"
                                                {{ old('peran', $peserta->peran) == $peran ? 'selected' : '' }}>
                                                {{ $peran }}</option>
                                        @endforeach
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="date-box">
                                    <strong class="text-center" style="font-size: larger;">Bukti Perjalanan Dinas</strong>
                                    <div class="mb-3">
                                        <label id="bukti_perjalanan_label" for="bukti_perjalanan">Surat Tugas</label>
                                        <input type="file" class="form-control" id="surat_tugas" name="surat_tugas"
                                            accept=".pdf,.jpg,.png">
                                        @error('file_upload')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="surat_tugas_label" for="surat_tugas">Tiket</label>
                                        <input type="file" class="form-control" id="surat_tugas" name="tiket"
                                            accept=".pdf,.jpg,.png">
                                        @error('file_upload')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="tiket_label" for="tiket">Bording Pass</label>
                                        <input type="file" class="form-control" id="tiket" name="boarding_pass"
                                            accept=".pdf,.jpg,.png">
                                        @error('file_upload')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="boarding_pass_label" for="boarding_pass">Bukti Perjalanan</label>
                                        <input type="file" class="form-control" id="boarding_pass"
                                            name="bukti_perjalanan" accept=".pdf,.jpg,.png">
                                        @error('file_upload')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="sppd_label" for="sppd">SPPD</label>
                                        <input type="file" class="form-control" id="sppd" name="sppd"
                                            accept=".pdf,.jpg,.png">
                                        @error('file_upload')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Lanjutkan dengan field lainnya (sesuaikan dengan form pendaftaran) -->

                            <div class="text-center mt-4 d-flex flex-column align-items-center">
                                <button type="submit" class="daftar-btn w-50 mb-3">Update</button>
                                <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                    class="btn btn-sm btn-outline-danger" style="width: 25%;">
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


@stack('scripts')
{{-- <script>
            document.getElementById('mobile-search-toggle').addEventListener('click', function() {
                var searchBox = document.getElementById('modal-search-box');

                searchBox.classList.toggle('show');

                if (searchBox.classList.contains('show')) {
                    searchBox.style.top = '0';
                }
            });

            document.addEventListener('click', function(event) {
                var searchBox = document.getElementById('modal-search-box');
                var toggleButton = document.getElementById('mobile-search-toggle');

                if (!searchBox.contains(event.target) && !toggleButton.contains(event.target)) {
                    searchBox.classList.remove('show');
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                const menuToggle = document.getElementById("menu-toggle");
                const sidebar = document.getElementById("sidebar-wrapper");
                const overlay = document.getElementById("overlay");

                menuToggle.addEventListener("click", function() {
                    sidebar.classList.toggle("active");
                    overlay.classList.toggle("active");
                });

                overlay.addEventListener("click", function() {
                    sidebar.classList.remove("active");
                    overlay.classList.remove("active");
                });
            });
        </script> --}}

<style>
    #wrapper {
        display: flex;
    }

    #sidebar-wrapper {
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        width: 250px;
        z-index: 1000;
        background-color: #f8f9fa;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        border-right: 1px solid #ddd;
    }

    #sidebar-wrapper.active {
        transform: translateX(0);
    }

    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 900;
        display: none;
    }

    #overlay.active {
        display: block;
    }

    .menu-section {
        margin-bottom: 20px;
    }

    .section-heading {
        font-size: 1rem;
        color: #343a40;
        background-color: transparent;
        padding-left: 10px;
        opacity: 0.8;
    }

    #page-content-wrapper {
        flex: 1;
        transition: all 0.3s ease;
    }

    .toggled #sidebar-wrapper {
        margin-left: -250px;
    }

    .bg-custom {
        background-color: #0090D4;
    }

    .heading-dashboard {
        background-color: transparent;
        color: #343a40;
    }

    .heading-agenda {
        background-color: transparent;
        color: #343a40;
        opacity: 0.8;
    }

    .list-group-item {
        padding: 15px 20px;
    }

    .list-group-item:hover {
        background-color: #e9ecef;
        color: #000;
    }

    .sidebar-heading {
        font-size: 1.2rem;
        background-color: #0090D4;
        color: #fff;
        padding: 10px;
    }

    #mobile-search-box {
        height: 0;
        opacity: 0;
        visibility: hidden;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    #mobile-search-box.show {
        height: auto;
        opacity: 1;
        visibility: visible;
        transition: all 0.3s ease-in-out;
    }

    .modal-search {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px 20px;
        border-bottom: 1px solid #ddd;
        z-index: 1000;
        transition: top 0.3s ease-in-out;
    }

    .modal-search.show {
        display: block;
    }

    .custom-footer {
        margin-top: 100px;
        padding: 20px 0;
    }
</style>
</body>

</html>
