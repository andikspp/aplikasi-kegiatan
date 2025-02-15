@extends('layouts.default')

@section('title', 'Daftar Kegiatan')

@section('content')
    <div class="container my-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom">
                        <h3 class="text-center text-white my-2">Daftar Kegiatan {{ $kegiatan->nama }}</h3>
                    </div>

                    <div class="card-body m-3">
                        <form action="{{ route('kegiatan.daftar.store', ['id' => $id]) }}" method="POST"
                            enctype="multipart/form-data" id="formPendaftaran">
                            @csrf
                            <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="{{ $kegiatan->id }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Nama Lengkap</strong>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            required>
                                        @error('nama_lengkap')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>NIP (Jika PNS)/NIK (Non PNS)</strong>
                                        <input type="text" class="form-control" id="nip" name="nip" required
                                            pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            onblur="checkNIP()">
                                        @error('nip')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Tempat Lahir</strong>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Masukkan Tempat Lahir" required>
                                        @error('tempat_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Tanggal Lahir</strong>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            required>
                                        @error('tanggal_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Jenis Kelamin</strong>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Agama</strong>
                                        <input type="text" class="form-control" id="agama" name="agama"
                                            placeholder="Masukkan Agama" required>
                                        @error('agama')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Pendidikan Terakhir</strong>
                                        <input type="text" class="form-control" id="pendidikan_terakhir"
                                            name="pendidikan_terakhir" placeholder="Masukkan Pendidikan Terakhir" required>
                                        @error('pendidikan_terakhir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Jabatan</strong>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            placeholder="Masukkan Jabatan" required>
                                        @error('jabatan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Pangkat/Golongan</strong>
                                        <input type="text" class="form-control" id="pangkat_golongan"
                                            name="pangkat_golongan" placeholder="Masukkan Pangkat/Golongan">
                                        @error('pangkat_golongan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Unit Kerja</strong>
                                        <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"
                                            placeholder="Masukkan Unit Kerja" required>
                                        @error('unit_kerja')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Alamat Kantor</strong>
                                        <input type="text" class="form-control" id="alamat_kantor"
                                            name="alamat_kantor" placeholder="Masukkan Alamat Kantor" required>
                                        @error('alamat_kantor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Telp Kantor</strong>
                                        <input type="text" class="form-control" id="telp_kantor" name="telp_kantor"
                                            placeholder="Masukkan Telp Kantor" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        @error('telp_kantor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Alamat Rumah</strong>
                                        <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"
                                            placeholder="Masukkan Alamat Rumah" required>
                                        @error('alamat_rumah')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Telp/HP</strong>
                                        <input type="number" class="form-control" id="telp_rumah" name="telp_rumah"
                                            placeholder="Masukkan Telp/HP" required>
                                        @error('telp_rumah')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>Alamat Email</strong>
                                        <input type="email" class="form-control" id="alamat_email" name="alamat_email"
                                            required>
                                        @error('alamat_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="date-box">
                                        <strong>NPWP</strong>
                                        <input type="text" class="form-control" id="npwp" name="npwp"
                                            placeholder="Masukkan NPWP" required>
                                        @error('npwp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if ($kegiatan->membutuhkan_nomor_rekening === 'ya')
                                <div class="date-box">
                                    <strong>Nomor Rekening</strong>
                                    <input type="number" class="form-control" id="nomor_rekening" name="nomor_rekening"
                                        required>
                                </div>
                            @endif

                            <div class="date-box">
                                <strong>Peran</strong>
                                <select class="form-select" id="peran" name="peran" required>
                                    <option value="">Pilih Peran</option>
                                    @foreach ($peranList as $peran)
                                        <option value="{{ $peran }}">{{ $peran }}</option>
                                    @endforeach
                                </select>
                                @error('peran')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="date-box">
                                <strong class="text-center" style="font-size: larger;">Bukti Perjalanan Dinas</strong>
                                <div class="mb-3">
                                    <label id="bukti_perjalanan_label" for="bukti_perjalanan">Surat Tugas</label>
                                    <input type="file" class="form-control" id="surat_tugas" name="surat_tugas"
                                        accept=".pdf,.jpg,.png">
                                    @error('file_upload')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="surat_tugas_label" for="surat_tugas">Tiket</label>
                                    <input type="file" class="form-control" id="surat_tugas" name="tiket"
                                        accept=".pdf,.jpg,.png">
                                    @error('file_upload')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="tiket_label" for="tiket">Bording Pass</label>
                                    <input type="file" class="form-control" id="tiket" name="boarding_pass"
                                        accept=".pdf,.jpg,.png">
                                    @error('file_upload')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="boarding_pass_label" for="boarding_pass">Bukti Perjalanan</label>
                                    <input type="file" class="form-control" id="boarding_pass"
                                        name="bukti_perjalanan" accept=".pdf,.jpg,.png">
                                    @error('file_upload')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="sppd_label" for="sppd">SPPD</label>
                                    <input type="file" class="form-control" id="sppd" name="sppd"
                                        accept=".pdf,.jpg,.png">
                                    @error('file_upload')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="box-ttd">
                                    <strong>Tanda Tangan</strong>
                                    <canvas id="canvas"></canvas>
                                    <button id="clear" class="btn btn-danger mt-2">Hapus Tanda Tangan</button>

                                    <!-- Input hidden untuk menyimpan data tanda tangan base64 -->
                                    <input type="hidden" name="signature" id="signature" required>

                                    @error('signature')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="text-center mt-4 d-flex flex-column align-items-center">
                                <button type="submit" class="daftar-btn w-50 mb-3">Daftar</button>
                                <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                    class="btn btn-sm btn-outline-danger" style="width: 25%;">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #f5f7ff;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .date-box {
            background: #f8faff;
            border: 1px solid rgba(103, 126, 234, 0.1);
            border-radius: 12px;
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .date-box strong {
            display: block;
            color: #4b5563;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .date-box input,
        .date-box select {
            border: 1px solid #e0e6ed;
            border-radius: 8px;
        }

        .daftar-btn {
            background-color: #0090D4;
            border: none;
            padding: 1rem 2.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 12px;
            transition: all 0.3s ease;
            color: #ffffff;
            font-size: 1.1rem;
            box-shadow: 0 4px 6px rgba(132, 250, 176, 0.2);
        }

        .daftar-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(132, 250, 176, 0.3);
        }

        .box-ttd {
            position: relative;
            background-color: #f9f9f9;
            /* Warna latar belakang terang untuk kotak */
            padding: 20px;
            border: 1px solid #ddd;
            /* Border ringan di sekitar kotak */
            border-radius: 8px;
            /* Sudut yang membulat */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Efek bayangan lembut untuk menambah kedalaman */
        }

        .box-ttd strong {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
            /* Memberikan jarak antara judul dan konten */
            font-weight: bold;
            color: #333;
            /* Warna teks yang lebih gelap untuk judul */
        }

        #canvas {
            width: 100%;
            height: 150px;
            /* Sesuaikan tinggi canvas sesuai dengan preferensi Anda */
            border: 2px solid #007bff;
            /* Border lebih menonjol */
            border-radius: 8px;
            /* Sudut yang lebih membulat */
            background-color: #fff;
            /* Warna latar belakang canvas */
            touch-action: none;
            /* Menonaktifkan zoom atau geser pada perangkat sentuh */
            cursor: crosshair;
            /* Menambahkan ikon kursor pensil ketika menggambar */
            margin-bottom: 10px;
            /* Memberikan jarak antara canvas dan tombol hapus */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Shadow ringan */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            /* Transisi halus */
        }

        #canvas:hover {
            border-color: #0056b3;
            /* Warna border lebih gelap saat hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Shadow lebih tebal saat hover */
        }

        @media (max-width: 768px) {
            #canvas {
                height: 100px;
                /* Tinggi lebih kecil untuk mobile */
            }
        }

        #clear {
            display: inline-block;
            padding: 8px 16px;
            background-color: #d9534f;
            /* Warna merah untuk tombol hapus */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #clear:hover {
            background-color: #c9302c;
            /* Mengubah warna tombol saat dihover */
        }

        #clear:focus {
            outline: none;
            /* Menghilangkan outline saat tombol terpilih */
        }

        .text-danger {
            font-size: 12px;
            color: #f44336;
            /* Warna merah untuk pesan error */
            margin-top: 10px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        function updateLabel(labelId, input) {
            const label = document.getElementById(labelId);
            label.textContent = input.files.length > 0 ? input.files[0].name : 'Pilih File';
        }

        function checkNIP() {
            const nip = document.getElementById('nip').value;
            if (nip) {
                fetch(`{{ route('kegiatan.checkNip') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            nip
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            // Isi form dengan data yang ditemukan
                            document.getElementById('nama_lengkap').value = data.nama_lengkap || '';
                            document.getElementById('tempat_lahir').value = data.tempat_lahir || '';
                            document.getElementById('tanggal_lahir').value = data.tanggal_lahir || '';
                            document.getElementById('jenis_kelamin').value = data.jenis_kelamin || '';
                            document.getElementById('agama').value = data.agama || '';
                            document.getElementById('pendidikan_terakhir').value = data.pendidikan_terakhir || '';
                            document.getElementById('jabatan').value = data.jabatan || '';
                            document.getElementById('pangkat_golongan').value = data.pangkat_golongan || '';
                            document.getElementById('unit_kerja').value = data.unit_kerja || '';
                            document.getElementById('alamat_kantor').value = data.alamat_kantor || '';
                            document.getElementById('telp_kantor').value = data.telp_kantor || '';
                            document.getElementById('alamat_rumah').value = data.alamat_rumah || '';
                            document.getElementById('telp_rumah').value = data.telp_rumah || '';
                            document.getElementById('alamat_email').value = data.alamat_email || '';
                            document.getElementById('npwp').value = data.npwp || '';
                            document.getElementById('peran').value = data.peran_id || '';

                            // SweetAlert untuk sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Data ditemukan',
                                text: 'Data NIP berhasil ditemukan dan formulir telah diisi.',
                                confirmButtonText: 'OK',
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal memeriksa NIP. Silakan coba lagi nanti.',
                            confirmButtonText: 'OK',
                        });
                    });
            }
        }

        $(document).ready(function() {
            // Inisialisasi SignaturePad
            const canvas = document.getElementById('canvas');
            const signaturePad = new SignaturePad(canvas);

            // Set ukuran canvas
            canvas.width = 400;
            canvas.height = 150;

            // Hapus tanda tangan
            $('#clear').click(function() {
                signaturePad.clear();
            });

            // Kirim form menggunakan AJAX
            $('#formPendaftaran').submit(function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default

                // Cek jika tanda tangan kosong
                if (signaturePad.isEmpty()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tanda tangan harus diisi!',
                    });
                    return;
                }

                // Ambil data base64 dari signaturePad
                const signatureData = signaturePad.toDataURL();

                // Set data base64 ke input hidden
                $('#signature').val(signatureData);

                // Ambil data form
                const formData = new FormData(this);

                // Kirim data form menggunakan AJAX
                $.ajax({
                    url: $(this).attr('action'), // Ambil URL dari form action
                    type: 'POST',
                    data: formData,
                    processData: false, // Jangan memproses data
                    contentType: false, // Jangan set content type
                    success: function(response) {
                        // Tampilkan pesan sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: response.message, // Pesan sukses dari backend
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            // Redirect ke halaman yang ditentukan
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            } else {
                                // Redirect ke halaman default jika redirect_url tidak terdefinisi
                                window.location.href =
                                '/kegiatan'; // Ganti dengan URL default
                            }
                        });
                    },
                    error: function(response) {
                        let errorMessage = 'Terjadi kesalahan! Silakan coba lagi.';
                        if (response.responseJSON && response.responseJSON.message) {
                            errorMessage = response.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                        });
                    }
                });
            });
        });
    </script>
@endsection
