@extends('layouts.menu.layout-dashboard')
@section('title', 'Kegiatan')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Daftar Kegiatan</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('tambah-kegiatan') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah Kegiatan</a>
        <button class="btn btn-primary" id="filterButton" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="fas fa-filter"></i> Filter
        </button>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select id="bulan" class="form-select">
                            <option value="">Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" id="tahun" class="form-control" placeholder="Tahun" value="2024">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="applyFilter()">Terapkan</button>
                </div>
            </div>
        </div>
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
            <input type="search" id="search" class="form-control d-inline-block w-auto" onkeyup="filterKegiatan()">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped" id="kegiatanTable">
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
                <tr data-bulan="{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('n') }}"
                    data-tahun="{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('Y') }}">
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
                    <td>{{ $kegiatan->pesertakegiatan->count() ?? 'Tidak Ada' }}</td>
                    <td>{{ $kegiatan->pokja->name }}</td>
                    <td>{{ $kegiatan->menggunakan_sertifikat === 'ya' ? 'Ada' : 'Tidak Ada' }}</td>
                    <td>{{ $kegiatan->menggunakan_sertifikat === 'ya' ? 'Ada' : 'Tidak Ada' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            onclick="confirmDelete('{{ $kegiatan->id }}')">
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
                                <li><a class="dropdown-item"
                                        onclick="copyDaftarKegiatan('{{ route('kegiatan.show', $kegiatan->id) }}')">Salin
                                        Link Kegiatan</a></li>

                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3" style="margin-bottom: 40px;">
            <!-- Menambahkan margin-bottom -->
            <p class="mb-0">Menampilkan {{ $kegiatans->firstItem() }} sampai {{ $kegiatans->lastItem() }} dari
                {{ $kegiatans->total() }}
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
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/kegiatan-delete/${id}`;
                }
            });
        }


        function copyDaftarKegiatan(link) {
            navigator.clipboard.writeText(link)
        }

        function filterKegiatan() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('kegiatanTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let found = false;
                for (let j = 1; j < td.length - 1; j++) { // Skip No and Aksi columns
                    if (td[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }

        function applyFilter() {
            const bulan = document.getElementById('bulan').value;
            const tahun = document.getElementById('tahun').value;
            const tableRows = document.querySelectorAll('#kegiatanTable tbody tr');

            tableRows.forEach(row => {
                const rowBulan = row.getAttribute('data-bulan');
                const rowTahun = row.getAttribute('data-tahun');

                if ((bulan === "" || rowBulan == bulan) && (tahun === "" || rowTahun == tahun)) {
                    row.style.display = ""; // Tampilkan baris
                } else {
                    row.style.display = "none"; // Sembunyikan baris
                }
            });

            // Tutup modal setelah menerapkan filter
            const filterModal = bootstrap.Modal.getInstance(document.getElementById('filterModal'));
            filterModal.hide();
        }
</script>
@endsection