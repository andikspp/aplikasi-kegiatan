<!-- resources/views/layouts/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata {{ $kegiatan->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/logo kemendikbudristek.png') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</head>

<body>
    <div class="container mt-5">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form class="bg-light p-4 rounded shadow" action="{{ route('isi.biodata.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h1 class="mb-4 text-center" style="font-size: larger; font-weight: bold;">Biodata {{ $kegiatan->nama }}
            </h1>
            <div class="mb-3">
                <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="{{ $kegiatan->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                    value="{{ Auth::user()->nama }}" placeholder="Masukkan Nama Lengkap" required readonly>
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP (jika PNS)</label>
                <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP"
                    value="{{ Auth::user()->nip }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                    placeholder="Masukkan Tempat Lahir" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukkan Agama" required>
            </div>
            <div class="mb-3">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir"
                    placeholder="Masukkan Pendidikan Terakhir" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan"
                    required>
            </div>
            <div class="mb-3">
                <label for="pangkat_golongan" class="form-label">Pangkat/Golongan (jika PNS)</label>
                <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan"
                    placeholder="Masukkan Pangkat/Golongan" required>
            </div>
            <div class="mb-3">
                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"
                    placeholder="Masukkan Unit Kerja" required>
            </div>
            <div class="mb-3">
                <label for="masa_kerja" class="form-label">Masa Kerja</label>
                <input type="text" class="form-control" id="masa_kerja" name="masa_kerja"
                    placeholder="Masukkan Masa Kerja" required>
            </div>
            <div class="mb-3">
                <label for="alamat_kantor" class="form-label">Alamat Kantor</label>
                <input type="text" class="form-control" id="alamat_kantor" name="alamat_kantor"
                    placeholder="Masukkan Alamat Kantor" required>
            </div>
            <div class="mb-3">
                <label for="telp_kantor" class="form-label">Telp</label>
                <input type="text" class="form-control" id="telp_kantor" name="telp_kantor"
                    placeholder="Masukkan Telp Kantor" required>
            </div>
            <div class="mb-3">
                <label for="alamat_rumah" class="form-label">Alamat Rumah</label>
                <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"
                    placeholder="Masukkan Alamat Rumah" required>
            </div>
            <div class="mb-3">
                <label for="telp_rumah" class="form-label">Telp/HP</label>
                <input type="text" class="form-control" id="telp_rumah" name="telp_rumah" placeholder="Masukkan Telp/HP"
                    required>
            </div>
            <div class="mb-3">
                <label for="alamat_email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="alamat_email" name="alamat_email"
                    value="{{ Auth::user()->email }}" placeholder="Masukkan Alamat Email" required readonly>
            </div>
            <div class="mb-3">
                <label for="npwp" class="form-label">NPWP</label>
                <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukkan NPWP" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Peran</label>
                <select class="form-select" id="peran" name="peran" required>
                    <option value="">Pilih Peran</option>
                    <option value="Peserta">Peserta</option>
                    <option value="Narasumber">Narasumber</option>
                    <option value="Fasilitator">Fasilitator</option>
                    <option value="Panitia">Panitia</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Upload File (Surat Tugas, Bukti Perjalanan,
                    Tiket, Bording
                    Pas, SPPD)</label>
                <input type="file" class="form-control" id="fileUpload" name="file_upload"
                    accept=".pdf,.doc,.docx,.jpg,.png">
            </div>
            <button type="submit" class="btn btn-success">Daftar</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-danger">Kembali</a>
        </form>
    </div>


    <!-- Footer -->
    <footer class="bg-custom text-white text-center text-lg-start custom-footer">
        <div class="text-center p-3">
            © 2024 Guru PAUD Dikmas | All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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