@extends('layouts.menu.layout-dashboard')
@section('title', 'Kelola Peserta')
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
                            <option>Provinsi</option>
                            <!-- Tambahkan opsi di sini -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option>Kabupaten</option>
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
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Jabatan</th>
                            <th>Pangkat/Golongan</th>
                            <th>Unit Kerja</th>
                            <th>Masa Kerja</th>
                            <th>Alamat Kantor</th>
                            <th>Telp Kantor</th>
                            <th>Alamat Rumah</th>
                            <th>Telp Rumah</th>
                            <th>Email</th>
                            <th>NPWP</th>
                            <th>Peran</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peserta as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->nama_lengkap }}</td>
                                <td>{{ $p->nip ?? '-' }}</td>
                                <td>{{ $p->tempat_lahir }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->agama }}</td>
                                <td>{{ $p->pendidikan_terakhir }}</td>
                                <td>{{ $p->jabatan }}</td>
                                <td>{{ $p->pangkat_golongan ?? '-' }}</td>
                                <td>{{ $p->unit_kerja }}</td>
                                <td>{{ $p->masa_kerja }}</td>
                                <td>{{ $p->alamat_kantor }}</td>
                                <td>{{ $p->telp_kantor }}</td>
                                <td>{{ $p->alamat_rumah }}</td>
                                <td>{{ $p->telp_rumah }}</td>
                                <td>{{ $p->alamat_email }}</td>
                                <td>{{ $p->npwp }}</td>
                                <td>{{ $p->peran }}</td>
                                <td>
                                    @if ($p->file_upload)
                                        <a href="{{ asset('storage/' . $p->file_upload) }}" target="_blank">Lihat
                                            File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('kegiatan.edit-peserta', $p->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete({{ $p->id }})">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="21" class="text-center">Tidak ada data peserta.</td>
                            </tr>
                        @endforelse
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
                window.location.href = `/kegiatan/kelolapeserta/delete/${id}`;
            }
        });
    }
</script>
