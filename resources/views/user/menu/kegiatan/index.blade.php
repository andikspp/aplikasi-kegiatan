@extends('user.layout.user-layout')
@section('title', 'Kegiatan')
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Kegiatan Diikuti</h1>

        <div class="d-flex justify-content-between mb-3">
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
                                    class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="mb-0">Menampilkan 1 sampai 10 dari
                    20
                    entri</p>
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
