@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Daftar Kegiatan</h1>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('tambah-kegiatan') }}" class="btn btn-primary">
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
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            Rapat Koordinasi Pengelolaan Kinerja Guru dan Kepala Sekolah Bagi PIC Dinas Pendidikan Region 1
                            <br>
                            <small class="text-muted">Kode Kegiatan: V32X7</small>
                        </td>
                        <td>16 s.d. 18 Oktober 2024</td>
                        <td>0</td>
                        <td>0</td>
                        <td>PPPK</td>
                        <td>Belum ada</td>
                        <td>Tidak ada ajuan.</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            Rapat Koordinasi Pemenuhan Formasi Guru ASN PPPK pada Instansi Daerah Tahun 2024 [REG 2 - Timur]
                            <br>
                            <small class="text-muted">Kode Kegiatan: AH6VL</small>
                        </td>
                        <td>17 s.d. 19 September 2024</td>
                        <td>0</td>
                        <td>501</td>
                        <td>PPPK</td>
                        <td>Belum ada</td>
                        <td>Tidak ada ajuan.</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </td>
                    </tr>
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

        .table td {
            vertical-align: middle;
        }
    </style>
@endsection
