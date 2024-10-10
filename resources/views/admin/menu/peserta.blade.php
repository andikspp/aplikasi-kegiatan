@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Daftar Peserta Kegiatan</div>

                    <div class="card-body">
                        <!-- Tombol Tambah Kegiatan -->
                        <div class="mb-3 text-start">
                            <button class="btn btn-primary" id="tambah-kegiatan">
                                <i class="fa fa-plus"></i> Tambahkan Pertanyaan
                            </button>
                        </div>

                        <!-- Tabel Daftar Kegiatan -->
                        <table id="table-kegiatan" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Buka/Tutup</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Jumlah Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="https://gurudikdas.kemdikbud.go.id/presensi/kegiatan/1" target="_blank">Evaluasi Kegiatan</a></td>
                                    <td>2023-11-14 19:34:00</td>
                                    <td>2023-11-14T12:56:57.000000Z</td>
                                    <td><span class="badge bg-primary">Template</span></td>
                                    <td>0 Peserta</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="https://gurudikdas.kemdikbud.go.id/presensi/kegiatan/2" target="_blank">Dampak Ngopi Selam</a></td>
                                    <td>2023-08-09 17:20:00</td>
                                    <td>2023-08-09T10:26:33.000000Z</td>
                                    <td><span class="badge bg-primary">Template</span></td>
                                    <td>0 Peserta</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>Showing 1 to 2 of 2 entries</div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .btn-primary {
            border-radius: 4px;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .badge {
            font-size: 90%;
        }

        .pagination .page-link {
            border-radius: 4px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
@endpush
