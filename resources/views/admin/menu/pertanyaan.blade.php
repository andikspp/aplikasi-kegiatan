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
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
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
                    <select class="form-control ml-2" style="width: 150px;" id="kategori_soal" name="kategori_soal" onchange="showInputFields()">
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
                
                <div id="inputFields" class="d-flex align-items-start flex-column"></div> <!-- Tempat untuk input tambahan -->

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
                    <div style="margin-left: 10px;"> <!-- Tambahkan margin di sini -->
                        <button type="button" class="btn btn-link"><i class="fas fa-ellipsis-v"></i></button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary mt-3">
                <i class="fas fa-plus"></i> Tambah Item
            </button>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div> <!-- Tutup container -->

    <script>
        let answerCount = 2; // Mulai dari 2 karena sudah ada 2 jawaban default

        function showInputFields() {
            const kategori = document.getElementById('kategori_soal').value;
            const inputFields = document.getElementById('inputFields');
            inputFields.innerHTML = ''; // Kosongkan inputFields sebelum menambahkan yang baru
            answerCount = 2; // Reset counter

            if (kategori === 'pilihan_ganda' || kategori === 'pilihan_ganda_multiple') {
                inputFields.innerHTML = `
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="jawaban" id="jawaban1" value="1">
                        <input type="text" class="form-control d-inline-block" placeholder="Jawaban 1" style="width: auto; flex-grow: 1;">
                        <button type="button" class="btn btn-danger" onclick="removeAnswerField(this)">X</button>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="jawaban" id="jawaban2" value="2">
                        <input type="text" class="form-control d-inline-block" placeholder="Jawaban 2" style="width: auto; flex-grow: 1;">
                        <button type="button" class="btn btn-danger" onclick="removeAnswerField(this)">X</button>
                    </div>
                `;
                inputFields.insertAdjacentHTML('beforeend', '<button type="button" class="btn btn-link" onclick="addAnswerField()">Tambah Opsi</button>');
            } else if (kategori === 'tanggal') {
                inputFields.innerHTML = '<input type="date" class="form-control mr-2" placeholder="Tanggal" style="flex-grow: 1;">';
            } else if (kategori === 'file') {
                inputFields.innerHTML = '<input type="file" class="form-control mr-2" style="flex-grow: 1;">';
            }
            // Tambahkan lebih banyak kondisi sesuai kebutuhan
        }

        function addAnswerField() {
            const inputFields = document.getElementById('inputFields');
            answerCount++; // Increment counter for new answer
            const newAnswerField = `
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="jawaban" id="jawaban${answerCount}">
                    <input type="text" class="form-control d-inline-block" placeholder="Jawaban ${answerCount}" style="width: auto; flex-grow: 1;">
                    <button type="button" class="btn btn-danger" onclick="removeAnswerField(this)">X</button>
                </div>
            `;
            inputFields.insertAdjacentHTML('afterbegin', newAnswerField); // Tambahkan input jawaban baru di atas
        }

        function removeAnswerField(button) {
            const inputField = button.parentElement;
            inputField.remove(); // Hapus input jawaban
        }
    </script>
@endsection
