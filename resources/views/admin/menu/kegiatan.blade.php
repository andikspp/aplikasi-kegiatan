@extends('layouts.menu.layout-dashboard')
@section('title', 'Kegiatan')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Daftar Kegiatan</h1>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('tambah-kegiatan') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Kegiatan</a>
            <button class="btn btn-primary">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>

        <div class="mb-3">
            <label for="showEntries" class="me-2">Show</label>
            <select id="showEntries" class="form-select d-inline-block w-auto me-2">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <label>entries</label>

            <div class="float-end">
                <label for="search" class="me-2">Search:</label>
                <input type="search" id="search" class="form-control d-inline-block w-auto">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Jumlah JP</th>
                        <th>Jumlah Peserta</th>
                        <th>Pokja</th>
                        <th>Status Sertifikat</th>
                        <th>Status Ajuan SK Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $index => $kegiatan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('hasilkegiatan', ['id' => $kegiatan->id]) }}" class="kegiatan-link">
                                    {{ $kegiatan->nama }}
                                </a>
                                <br>
                                <span class="kode-kegiatan">Kode Kegiatan:
                                    <strong>{{ $kegiatan->id }}</strong></span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}</td>
                            <td>{{ $kegiatan->jumlah_jp }}</td>
                            <td>{{ $kegiatan->jumlah_peserta ?? 'Tidak Ada' }}</td>
                            <td>{{ $kegiatan->role }}</td>
                            <td>{{ $kegiatan->menggunakan_sertifikat === 'ya' ? 'Ada' : 'Tidak Ada' }}</td>
                            <td>{{ $kegiatan->menggunakan_sertifikat === 'ya' ? 'Ada' : 'Tidak Ada' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="confirmDelete({{ $kegiatan->id }})">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>

                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item"
                                                href="{{ route('hasilkegiatan', ['id' => $kegiatan->id]) }}">Lihat/Ubah</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Daftar Peserta</a></li>
                                        <li><a class="dropdown-item" href="#">Unggah Ajuan SK Sertifikat</a></li>
                                        <li><a class="dropdown-item" href="#">Unduh Presensi</a></li>
                                        <li><a class="dropdown-item" href="#">Unduh Biodata</a></li>
                                        <li><a class="dropdown-item" href="#">Unduh Sertifikat</a></li>
                                        <li><a class="dropdown-item" href="#">Sebaran Peserta</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="mb-0">Menampilkan 1 sampai 10 dari 20 entri</p>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <style>
        .table th {
            background-color: #f8f9fa;
        }

        .kode-kegiatan {
            color: #6c757d;
            /* Warna abu-abu untuk kode kegiatan */
            font-size: 0.9em;
            /* Ukuran font lebih kecil */
        }

        .table td {
            vertical-align: middle;
        }

        .kegiatan-link {
            color: #007bff;
            text-decoration: none;
        }

        .kegiatan-link:hover {
            text-decoration: none;
            color: #0056b3;
            /* Warna biru yang sedikit lebih gelap saat dihover */
        }
    </style>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/kegiatan-delete/${id}`;
                }
            });
        }
    </script>
@endsection
