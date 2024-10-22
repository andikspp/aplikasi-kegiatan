@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow">
                    <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Ubah Pertanyaan</h1>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="judul">Judul *</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi..."></textarea>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_mulai">Tanggal Quizz <span style="color: red;">*</span></label>
                                <div class="col-md-6">
                                    <label for="tanggal_mulai">Mulai</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_selesai">Selesai</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="syarat_unduh">Syarat untuk mengunduh sertifikat</label>
                                <select class="form-control" id="syarat_unduh" name="syarat_unduh">
                                    <option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form id="formTambahSoal" class="bg-light p-4 rounded shadow">
            <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Tambahkan Soal</h1>
            <div class="item-Kegiatan mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <input type="text" class="form-control mr-2" placeholder="Pertanyaan" style="flex-grow: 1;" id="pertanyaan">
                    <select class="form-control ml-2" style="width: 150px; margin-left: 10px;" id="kategori_soal" name="kategori_soal" onchange="showInputFields()">
                        <option value="essai">Essai</option>
                        <option value="nomor">Nomor</option>
                        <option value="tanggal">Tanggal</option>
                        <option value="email">Email</option>
                        <option value="url">Url</option>
                        <option value="pilihan_ganda">Pilihan Ganda</option>
                        <option value="pilihan_ganda_multiple">Pilihan Ganda (jawaban lebih dari satu)</option>
                        <option value="skala">Skala</option>
                        <option value="label">Label</option>
                        <option value="drop_down">Drop-down</option>
                        <option value="file">File</option>
                    </select>
                </div>

                <div id="deskripsiContainer" style="display: none;">
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi..."></textarea>
                </div>
                
                <div id="inputFields" class="d-flex align-items-start flex-column" style="margin-top: 15px;"></div> <!-- Tempat untuk input tambahan -->

                <div class="d-flex align-items-center justify-content-end">
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-success mr-5"><i class="fas fa-arrow-down"></i></button>
                    </div>
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-primary mr-5"><i class="fas fa-copy"></i></button>
                    </div>
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-danger mr-5"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="custom-control custom-switch mr-5" style="margin-left: 10px;">
                        <input type="checkbox" class="custom-control-input" id="wajibDiisi">
                        <label class="custom-control-label" for="wajibDiisi">Wajib diisi</label>
                    </div>
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-link" onclick="toggleDeskripsi()"><i class="fas fa-ellipsis-v"></i></button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3" style="background-color: blue; color: white;">
                    <i class="fas fa-plus"></i> Tambah Item
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleDeskripsi() {
        const deskripsiContainer = document.getElementById('deskripsiContainer');
        deskripsiContainer.style.display = deskripsiContainer.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection