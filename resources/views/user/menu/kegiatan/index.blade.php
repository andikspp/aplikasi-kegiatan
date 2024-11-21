@extends('user.layout.user-layout')
@section('title', 'Kegiatan')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Kegiatan Diikuti</h1>

        <div class="d-flex justify-content-between flex-wrap mb-3">
            <button class="btn btn-primary mb-2">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>

        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-auto mb-2">
                <label for="showEntries" class="me-2">Show</label>
                <select id="showEntries" class="form-select d-inline-block w-auto me-2">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <label>entries</label>
            </div>
            <div class="col-12 col-md-auto ms-auto">
                <label for="search" class="me-2">Search:</label>
                <input type="search" id="search" class="form-control d-inline-block w-100 w-md-auto">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Jumlah Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatanList as $key => $peserta)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $peserta->kegiatan->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($peserta->kegiatan->tanggal_kegiatan)->format('d F Y') }}</td>
                            <td>{{ $peserta->kegiatan->peserta->count() }}</td> <!-- Menghitung jumlah peserta -->
                            <td>
                                <a href="{{ route('user.edit-kegiatan', ['id' => $peserta->kegiatan->id]) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete('{{ $peserta->id }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
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

    <style>
        .table th {
            background-color: #f8f9fa;
        }

        .table td {
            vertical-align: middle;
        }

        @media (max-width: 768px) {

            .table th,
            .table td {
                white-space: nowrap;
                font-size: 0.9rem;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .pagination {
                flex-wrap: wrap;
            }

            .btn-sm {
                font-size: 0.8rem;
                padding: 0.4rem 0.6rem;
            }
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
                    window.location.href = `/user/destroy-kegiatan/${id}`;
                }
            });
        }
    </script>
@endsection
