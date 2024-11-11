@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <a href="{{ route('hasilkegiatan', ['id' => $kegiatan->id]) }}" class="btn btn-link me-2">
                <i class="fas fa-calendar"></i> Kelola Kegiatan
            </a>
            <a href="{{ route('kelolapeserta', ['id' => $kegiatan->id]) }}" class="btn btn-primary me-2">
                <i class="fas fa-users"></i> Kelola Peserta
            </a>
            <a href="{{ route('kelolalainnya', ['id' => $kegiatan->id]) }}" class="btn btn-link">
                <i class="fas fa-cogs"></i> Kelola Lainnya
            </a>
        </div>

        <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow">
            <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Ubah Peserta</h1>
            <div class="filter-section mb-4">
                <h5>Filter</h5>
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select">
                            <option>Pilih Provinsi/Kabupaten</option>
                            <!-- Tambahkan opsi di sini -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Instansi">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option>Pilih Peran</option>
                            <!-- Tambahkan opsi di sini -->
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">Terapkan</button>
            </div>

            <div class="actions mb-4">
                <button class="btn btn-outline-primary"><i class="fas fa-print"></i> Cetak Biodata</button>
                <button class="btn btn-primary"><i class="fas fa-download"></i> Unduh</button>
                <button class="btn btn-success"><i class="fas fa-upload"></i> Unggah</button>
            </div>

            <div class="mt-3">
                <label for="entries">Show</label>
                <select id="entries" class="form-select d-inline w-auto">
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <span>entries</span>
                <input type="text" class="form-control d-inline w-auto" placeholder="Search:" style="margin-left: 10px;">
            </div>

            <div style="overflow-x: auto;">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>No.</th>
                            <th>Uniq ID</th>
                            <th>Urut</th>
                            <th>Timestamp</th>
                            <th>NIK</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Email</th>
                            <th>HP</th>
                            <th>Peran</th>
                            <th>Status Presensi</th>
                            <th>Predikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>1</td>
                            <td>GgqaNXiw6L</td>
                            <td>-</td>
                            <td>10/15/2024, 1:10:51 PM</td>
                            <td>5302010204790002</td>
                            <td>1979040222014061003</td>
                            <td>JEMRI SALUK</td>
                            <td>Dinas Pendidikan dan Kebudayaan</td>
                            <td>jewarelatris1979@gmail.com</td>
                            <td>62819183739183</td>
                            <td>p</td>
                            <td>Peserta</td>
                            <td>p</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Predikat
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"
                                            onclick="selectPredikat('Sangat Baik')">Sangat Baik</a>
                                        <a class="dropdown-item" href="#" onclick="selectPredikat('Baik')">Baik</a>
                                        <a class="dropdown-item" href="#" onclick="selectPredikat('Cukup Baik')">Cukup
                                            Baik</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>2</td>
                            <td>Abcde12345</td>
                            <td>-</td>
                            <td>10/16/2024, 2:00:00 PM</td>
                            <td>5302010204790003</td>
                            <td>1979040222014061004</td>
                            <td>ANDI SETIAWAN</td>
                            <td>Dinas Kesehatan</td>
                            <td>andi.setiawan@example.com</td>
                            <td>6281234567890</td>
                            <td>p</td>
                            <td>Peserta</td>
                            <td>p</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Predikat
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"
                                            onclick="selectPredikat('Sangat Baik')">Sangat Baik</a>
                                        <a class="dropdown-item" href="#" onclick="selectPredikat('Baik')">Baik</a>
                                        <a class="dropdown-item" href="#" onclick="selectPredikat('Cukup Baik')">Cukup
                                            Baik</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>3</td>
                            <td>Fghij67890</td>
                            <td>-</td>
                            <td>10/17/2024, 3:30:00 PM</td>
                            <td>5302010204790004</td>
                            <td>1979040222014061005</td>
                            <td>SITI NURHALIZA</td>
                            <td>Dinas Sosial</td>
                            <td>siti.nurhaliza@example.com</td>
                            <td>6280987654321</td>
                            <td>p</td>
                            <td>Peserta</td>
                            <td>p</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Predikat
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"
                                            onclick="selectPredikat('Sangat Baik')">Sangat Baik</a>
                                        <a class="dropdown-item" href="#" onclick="selectPredikat('Baik')">Baik</a>
                                        <a class="dropdown-item" href="#" onclick="selectPredikat('Cukup Baik')">Cukup
                                            Baik</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Tambahkan baris data lainnya di sini -->
                    </tbody>
                </table>
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

<script>
    function selectPredikat(predikat) {
        alert('Predikat terpilih: ' + predikat);
        // Tambahkan logika untuk menyimpan predikat yang dipilih
    }
</script>
