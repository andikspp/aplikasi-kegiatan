@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center"><strong style="font-size: 24px;">Quizz</strong></div>

                    <div class="card-body">
                        <!-- Tombol Tambah Kegiatan -->
                        <div class="mb-3 text-start">
                            <a href="{{ route('pertanyaan') }}" class="btn btn-primary" id="tambah-kegiatan">
                                <i class="fa fa-plus"></i> Buat Quizz
                            </a>
                            {{-- <button class="btn btn-primary" id="tambah-kegiatan">
                                <i class="fa fa-plus"></i> Tambahkan Pertanyaan
                            </button> --}}
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
                                @foreach($quizzes as $index => $quiz)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="https://gurudikdas.kemdikbud.go.id/presensi/kegiatan/{{ $quiz->id }}" target="_blank">{{ $quiz->nama_quiz }}</a></td>
                                        <td>{{ $quiz->tanggal_buka }} / {{ $quiz->tanggal_tutup }}</td>
                                        <td>{{ $quiz->lokasi ?? 'N/A' }}</td>
                                        <td><span class="badge bg-primary">{{ $quiz->status }}</span></td>
                                        <td>{{ $quiz->jumlah_peserta ?? '0 Peserta' }}</td>
                                    </tr>
                                @endforeach
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
