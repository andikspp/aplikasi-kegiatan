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
                        <select id="provinsi" class="form-select" onchange="filterKabupaten()">
                            <option value="">Pilih Provinsi</option>
                            <option value="aceh">Aceh</option>
                            <option value="bali">Bali</option>
                            <option value="banten">Banten</option>
                            <option value="bengkulu">Bengkulu</option>
                            <option value="di_yogyakarta">DI Yogyakarta</option>
                            <option value="dki_jakarta">DKI Jakarta</option>
                            <option value="jateng">Jawa Tengah</option>
                            <option value="jatim">Jawa Timur</option>
                            <option value="jabar">Jawa Barat</option>
                            <option value="kalbar">Kalimantan Barat</option>
                            <option value="kalsel">Kalimantan Selatan</option>
                            <option value="kalteng">Kalimantan Tengah</option>
                            <option value="kaltim">Kalimantan Timur</option>
                            <option value="kep_bangka_belitung">Kep. Bangka Belitung</option>
                            <option value="kepulauan_riau">Kepulauan Riau</option>
                            <option value="lampung">Lampung</option>
                            <option value="maluku">Maluku</option>
                            <option value="maluku_utara">Maluku Utara</option>
                            <option value="ntb">Nusa Tenggara Barat</option>
                            <option value="ntt">Nusa Tenggara Timur</option>
                            <option value="papua">Papua</option>
                            <option value="papua_barat">Papua Barat</option>
                            <option value="riau">Riau</option>
                            <option value="sulawesi_barat">Sulawesi Barat</option>
                            <option value="sulawesi_selatan">Sulawesi Selatan</option>
                            <option value="sulawesi_tengah">Sulawesi Tengah</option>
                            <option value="sulawesi_utara">Sulawesi Utara</option>
                            <option value="sumatera_barat">Sumatera Barat</option>
                            <option value="sumatera_selatan">Sumatera Selatan</option>
                            <option value="sumatera_utara">Sumatera Utara</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select id="kabupaten" class="form-select">
                            <option value="">Pilih Kabupaten</option>
                            <!-- Opsi kabupaten akan diisi berdasarkan provinsi yang dipilih -->
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="search" class="form-label">Search:</label>
                    <input type="text" id="search" class="form-control" placeholder="Cari peserta..."
                        oninput="applySearch()">
                </div>
            </div>

            <div class="actions mb-4">
                <a href="{{ route('peserta.cetak-biodata', ['kegiatan_id' => $kegiatan->id]) }}" class="btn btn-primary">
                    Cetak Biodata
                </a>

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
            </div>

            <div style="overflow-x: auto;">
                <table class="table mt-4" id="pesertaTable">
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
                            <th>Alamat Kantor</th>
                            <th>Telp Kantor</th>
                            <th>Alamat Rumah</th>
                            <th>Telp Rumah</th>
                            <th>Email</th>
                            <th>NPWP</th>
                            <th>Peran</th>
                            <th>Surat Tugas</th>
                            <th>Tiket</th>
                            <th>Boarding Pass</th>
                            <th>Bukti Perjalanan</th>
                            <th>SPPD</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pesertaBody">
                        @forelse ($peserta as $index => $p)
                            <tr data-provinsi="{{ $p->provinsi }}" data-kabupaten="{{ $p->kabupaten }}">
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
                                <td>{{ $p->alamat_kantor }}</td>
                                <td>{{ $p->telp_kantor }}</td>
                                <td>{{ $p->alamat_rumah }}</td>
                                <td>{{ $p->telp_rumah }}</td>
                                <td>{{ $p->alamat_email }}</td>
                                <td>{{ $p->npwp }}</td>
                                <td>{{ $p->peran }}</td>
                                <td>
                                    @if ($p->surat_tugas)
                                        <a href="{{ asset('storage/' . $p->surat_tugas) }}" target="_blank">Lihat
                                            File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    @if ($p->tiket)
                                        <a href="{{ asset('storage/' . $p->tiket) }}" target="_blank">Lihat
                                            File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    @if ($p->boarding_pass)
                                        <a href="{{ asset('storage/' . $p->boarding_pass) }}" target="_blank">Lihat
                                            File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    @if ($p->bukti_perjalanan)
                                        <a href="{{ asset('storage/' . $p->bukti_perjalanan) }}" target="_blank">Lihat
                                            File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    @if ($p->sppd)
                                        <a href="{{ asset('storage/' . $p->sppd) }}" target="_blank">Lihat
                                            File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kegiatan.edit-peserta', $p->id) }}"
                                            class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete('{{ $p->id }}')">
                                            Hapus
                                        </button>
                                    </div>
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
            color: #0d6efd;
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

    function filterKabupaten() {
        const provinsi = document.getElementById('provinsi').value;
        const kabupatenSelect = document.getElementById('kabupaten');
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>'; // Reset kabupaten

        const kabupatenData = {
            aceh: ['Aceh Besar', 'Bireuen', 'Gayo Lues', 'Langsa', 'Lhokseumawe', 'Nagan Raya', 'Pidie',
                'Simeulue'
            ],
            bali: ['Badung', 'Bangli', 'Buleleng', 'Gianyar', 'Jembrana', 'Karangasem', 'Kota Denpasar', 'Tabanan'],
            banten: ['Banten', 'Tangerang', 'Tangerang Selatan', 'Serang', 'Cilegon', 'Lebak', 'Pandeglang'],
            bengkulu: ['Bengkulu', 'Bengkulu Selatan', 'Bengkulu Utara', 'Kaur', 'Seluma', 'Rejang Lebong',
                'Lebong'
            ],
            di_yogyakarta: ['Bantul', 'Gunungkidul', 'Kulon Progo', 'Sleman', 'Yogyakarta'],
            dki_jakarta: ['Jakarta Barat', 'Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Utara'],
            jateng: ['Banyumas', 'Batang', 'Blora', 'Boyolali', 'Brebes', 'Demak', 'Grobogan', 'Jepara',
                'Karanganyar', 'Kebumen', 'Klaten', 'Kudus', 'Pati', 'Pemalang', 'Purbalingga', 'Semarang',
                'Sragen', 'Sukoharjo', 'Tegal', 'Wonogiri', 'Wonosobo'
            ],
            jatim: ['Bangkalan', 'Banyuwangi', 'Blitar', 'Bojonegoro', 'Bondowoso', 'Gresik', 'Jember', 'Kediri',
                'Lamongan', 'Madiun', 'Magetan', 'Malang', 'Mojokerto', 'Nganjuk', 'Ngawi', 'Pamekasan',
                'Pasuruan', 'Ponorogo', 'Sampang', 'Sidoarjo', 'Situbondo', 'Trenggalek', 'Tuban', 'Tulungagung'
            ],
            jabar: ['Bandung', 'Bandung Barat', 'Bekasi', 'Bogor', 'Ciamis', 'Cianjur', 'Cirebon', 'Garut',
                'Indramayu', 'Karawang', 'Kuningan', 'Majalengka', 'Purwakarta', 'Subang', 'Sukabumi',
                'Sumedang', 'Tasikmalaya'
            ],
            kalbar: ['Bengkayang', 'Kapuas Hulu', 'Kubu Raya', 'Landak', 'Melawi', 'Mempawah', 'Pontianak',
                'Sambas', 'Sanggau', 'Sekadau', 'Singkawang', 'Sintang'
            ],
            kalsel: ['Banjar', 'Barito Kuala', 'Hulu Sungai Selatan', 'Hulu Sungai Tengah', 'Hulu Sungai Utara',
                'Kotabaru', 'Tabalong', 'Tanah Bumbu', 'Tanah Laut', 'Barito Selatan', 'Barito Utara'
            ],
            kalteng: ['Barito Selatan', 'Barito Utara', 'Gunung Mas', 'Kapuas', 'Katingan', 'Kotawaringin Barat',
                'Kotawaringin Timur', 'Lamandau', 'Murung Raya', 'Pulang Pisau', 'Seruyan', 'Sukamara'
            ],
            kaltim: ['Balikpapan', 'Bontang', 'Kutai Barat', 'Kutai Kartanegara', 'Kutai Timur', 'Mahakam Ulu',
                'Paser', 'Penajam Paser Utara', 'Samarinda'
            ],
            kep_bangka_belitung: ['Bangka', 'Bangka Selatan', 'Bangka Tengah', 'Bangka Barat', 'Belitung',
                'Belitung Timur'
            ],
            kepulauan_riau: ['Bintan', 'Karimun', 'Kota Batam', 'Kota Tanjung Pinang', 'Lingga', 'Natuna',
                'Anambas'
            ],
            lampung: ['Bandar Lampung', 'Lampung Selatan', 'Lampung Tengah', 'Lampung Utara', 'Tanggamus',
                'Way Kanan', 'Pesawaran', 'Pringsewu', 'Tulang Bawang', 'Tulang Bawang Barat', 'Metro'
            ],
            maluku: ['Maluku Tengah', 'Maluku Tenggara', 'Buru', 'Buru Selatan', 'Seram Bagian Barat',
                'Seram Bagian Timur', 'Kota Ambon'
            ],
            maluku_utara: ['Halmahera Barat', 'Halmahera Selatan', 'Halmahera Tengah', 'Halmahera Utara',
                'Kota Ternate', 'Kota Tidore Kepulauan'
            ],
            ntb: ['Bima', 'Dompu', 'Lombok Barat', 'Lombok Tengah', 'Lombok Timur', 'Sumbawa', 'Sumbawa Barat',
                'Kota Mataram'
            ],
            ntt: ['Alor', 'Ende', 'Flores Timur', 'Kupang', 'Lembata', 'Manggarai', 'Manggarai Barat', 'Nagekeo',
                'Ngada', 'Sikka', 'Sumba Barat', 'Sumba Timur', 'Timor Tengah Selatan', 'Timor Tengah Utara',
                'Kota Kupang'
            ],
            papua: ['Boven Digoel', 'Jayapura', 'Jayawijaya', 'Kepulauan Yapen', 'Lanny Jaya', 'Mamberamo Raya',
                'Mimika', 'Nabire', 'Paniai', 'Pegunungan Bintang', 'Sarmi', 'Supiori', 'Yahukimo', 'Yalimo'
            ],
            papua_barat: ['Fakfak', 'Kaimana', 'Manokwari', 'Maybrat', 'Pegunungan Arfak', 'Sorong',
                'Sorong Selatan', 'Teluk Bintuni', 'Teluk Wondama'
            ],
            riau: ['Bengkalis', 'Dumai', 'Indragiri Hilir', 'Indragiri Hulu', 'Kampar', 'Kuantan Singingi',
                'Pelalawan', 'Rokan Hilir', 'Rokan Hulu', 'Siak'
            ],
            sulawesi_barat: ['Majene', 'Mamasa', 'Mamuju', 'Polewali Mandar'],
            sulawesi_selatan: ['Bantaeng', 'Barru', 'Bone', 'Bulukumba', 'Enrekang', 'Gowa', 'Jeneponto', 'Luwu',
                'Luwu Utara', 'Luwu Timur', 'Makassar', 'Maros', 'Pangkep', 'Pinrang', 'Soppeng', 'Takalar',
                'Tana Toraja', 'Toraja Utara', 'Wajo'
            ],
            sulawesi_tengah: ['Banggai', 'Banggai Kepulauan', 'Buol', 'Donggala', 'Morowali', 'Palu', 'Poso',
                'Sigi', 'Tojo Una-Una', 'Toli-Toli'
            ],
            sulawesi_utara: ['Bolaang Mongondow', 'Bolaang Mongondow Selatan', 'Bolaang Mongondow Timur',
                'Bolaang Mongondow Utara', 'Minahasa', 'Minahasa Selatan', 'Minahasa Utara', 'Sangihe',
                'Sitaro', 'Sangihe', 'Talaud', 'Tomohon', 'Kota Manado'
            ],
            sumatera_barat: ['Agam', 'Dharmasraya', 'Kota Bukittinggi', 'Kota Padang', 'Kota Pariaman',
                'Kota Sawahlunto', 'Kota Solok', 'Lima Puluh Kota', 'Padang Pariaman', 'Pasaman',
                'Pasaman Barat', 'Sijunjung', 'Solok', 'Tanah Datar'
            ],
            sumatera_selatan: ['Banyuasin', 'Empat Lawang', 'Lahat', 'Muara Enim', 'OKU', 'OKU Selatan',
                'OKU Timur', 'Palembang', 'Pagar Alam', 'Prabumulih', 'Musirawas', 'Musirawas Utara', 'Lahat'
            ],
            sumatera_utara: ['Asahan', 'Batubara', 'Dairi', 'Deli Serdang', 'Humbang Hasundutan', 'Karo',
                'Labuhanbatu', 'Labuhanbatu Selatan', 'Labuhanbatu Utara', 'Langkat', 'Nias', 'Nias Barat',
                'Nias Selatan', 'Nias Utara', 'Simalungun', 'Tapanuli Selatan', 'Tapanuli Utara',
                'Tebing Tinggi', 'Kota Medan'
            ],
        };

        if (kabupatenData[provinsi]) {
            kabupatenData[provinsi].forEach(kabupaten => {
                kabupatenSelect.innerHTML +=
                    `<option value="${kabupaten.toLowerCase().replace(/ /g, "_")}">${kabupaten}</option>`;
            });
        }
    }

    function applySearch() {
        const searchValue = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('#pesertaBody tr');

        rows.forEach(row => {
            const namaLengkap = row.cells[1].textContent
                .toLowerCase(); // Mengambil nama lengkap dari kolom kedua
            if (namaLengkap.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function applyFilter() {
        const provinsi = document.getElementById('provinsi').value;
        const kabupaten = document.getElementById('kabupaten').value;
        const rows = document.querySelectorAll('#pesertaBody tr');

        rows.forEach(row => {
            const rowProvinsi = row.getAttribute('data-provinsi');
            const rowKabupaten = row.getAttribute('data-kabupaten');

            if ((provinsi === '' || rowProvinsi === provinsi) && (kabupaten === '' || rowKabupaten ===
                    kabupaten)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
