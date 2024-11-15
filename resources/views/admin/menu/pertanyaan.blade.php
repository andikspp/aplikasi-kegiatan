@extends('layouts.menu.layout-dashboard')
@section('title', 'Kelola Kuis')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow" action="{{ route('kuis.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Kelola Kuis</h1>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="kegiatan">Pilih Kegiatan</label>
                            <select name="kegiatan_id" id="kegiatan" class="form-control">
                                <option value="">-- Pilih Kegiatan --</option>
                                @foreach ($kegiatans as $kegiatan)
                                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi..."></textarea>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_mulai">Tanggal Kuis <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <label for="tanggal_mulai">Mulai</label>
                                <input type="datetime-local" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai">Selesai</label>
                                <input type="datetime-local" class="form-control" id="tanggal_selesai"
                                    name="tanggal_selesai" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="syarat_unduh">Syarat untuk mengunduh sertifikat <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="syarat_unduh" name="syarat_unduh">
                                <option value="tidak">Tidak</option>
                                <option value="ya">Ya</option>
                            </select>
                        </div>
                    </div>
                    <div class="container mt-4" class="bg-light p-4 rounded shadow">
                        <h1 class="mb-4" style="font-size: larger; font-weight: bold;">Tambahkan Soal</h1>
                        <hr style="border-top: 4px solid #000;">
                        <div id="soalContainer">
                            <div class="item-Kegiatan mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="text" class="form-control mr-2" placeholder="Pertanyaan" style="flex-grow: 1;"
                                        name="quiz_data[0][pertanyaan]">
                                    <select class="form-control ml-2" style="width: 150px; margin-left: 10px;" name="quiz_data[0][kategori_soal]"
                                        onchange="showInputFields(this)">
                                        <option value="essai">Essai</option>
                                        <option value="pilihan_ganda">Pilihan Ganda</option>
                                        <option value="pilihan_ganda_multiple">Pilihan Ganda (jawaban lebih dari satu)</option>
                                    </select>
                                </div>
                                <div class="deskripsiContainer" style="display: none;">
                                    <textarea class="form-control" rows="3" placeholder="Masukkan deskripsi..."></textarea>
                                </div>
                
                                <div id="inputFields" class="d-flex align-items-start flex-column" style="margin-top: 15px;"></div>
                
                                <div class="d-flex align-items-center justify-content-end">
                                    <div style="margin-left: 10px;">
                                        <button type="button" class="btn btn-success mr-5"><i class="fas fa-arrow-down"></i></button>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <button type="button" class="btn btn-primary mr-5" onclick="duplikatSoal(this)"><i
                                                class="fas fa-copy"></i></button>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <button type="button" class="btn btn-danger mr-5" onclick="hapusSoal(this)"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                    <div class="custom-control custom-switch mr-5" style="margin-left: 10px;">
                                        <input type="checkbox" class="custom-control-input" id="wajibDiisi" name="quiz_data[0][is_required]">
                                        <label class="custom-control-label" for="wajibDiisi">Wajib diisi</label>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <button type="button" class="btn btn-link" onclick="toggleDeskripsi(this)"><i
                                                class="fas fa-ellipsis-v"></i></button>
                                    </div>
                                </div>
                            </div>
                            <hr style="border-top: 4px solid #000;">
                        </div>
                
                        <button type="button" class="btn btn-primary mt-3 ms-2" onclick="tambahSoal()">+ Tambah Soal</button>
                        <button type="submit" class="btn btn-success mt-3 ms-2">Simpan</button>
                        <a href="{{ route('quizz.index') }}" class="btn btn-danger mt-3 ms-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    <script>
        let indexSoal = 0
        let indexPilihan = 0
        
        function tambahSoal() {
            indexSoal++
            indexPilihan = 0
            const soalContainer = document.getElementById('soalContainer');
            const newSoal = document.createElement('div');
            newSoal.className = 'item-Kegiatan mt-4';
            newSoal.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <input type="text" class="form-control mr-2" placeholder="Pertanyaan" style="flex-grow: 1;" name="quiz_data[${indexSoal}][pertanyaan]">
                    <select class="form-control ml-2" style="width: 150px; margin-left: 10px;" name="quiz_data[${indexSoal}][kategori_soal]" onchange="showInputFields(this)">
                        <option value="essai">Essai</option>
                        <!-- <option value="nomor">Nomor</option>
                        <option value="tanggal">Tanggal</option>
                        <option value="email">Email</option>
                        <option value="url">Url</option> --!>
                        <option value="pilihan_ganda">Pilihan Ganda</option>
                        <option value="pilihan_ganda_multiple">Pilihan Ganda (jawaban lebih dari satu)</option>
                        <!-- <option value="skala">Skala</option>
                        <option value="label">Label</option>
                        <option value="drop_down">Drop-down</option>
                        <option value="file">File</option> --!>
                    </select>
                </div>
                <div class="deskripsiContainer" style="display: none;">
                    <textarea class="form-control" rows="3" placeholder="Masukkan deskripsi..."></textarea>
                </div>
                <div id="inputFields" class="d-flex align-items-start flex-column" style="margin-top: 15px;"></div>
                <div class="d-flex align-items-center justify-content-end">
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-success mr-5"><i class="fas fa-arrow-down"></i></button>
                    </div>
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-primary mr-5" onclick="duplikatSoal(this)"><i class="fas fa-copy"></i></button>
                    </div>
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-danger mr-5" onclick="hapusSoal(this)"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="custom-control custom-switch mr-5" style="margin-left: 10px;">
                        <input type="checkbox" class="custom-control-input" id="wajibDiisi" name="quiz_data[${indexSoal}][is_required]">
                        <label class="custom-control-label" for="wajibDiisi">Wajib diisi</label>
                    </div>
                    <div style="margin-left: 10px;">
                        <button type="button" class="btn btn-link" onclick="toggleDeskripsi(this)"><i class="fas fa-ellipsis-v"></i></button>
                    </div>
                </div>
                <hr style="border-top: 4px solid #000;">
            `;
            soalContainer.appendChild(newSoal);
        }

        function toggleDeskripsi(button) {
            const deskripsiContainer = button.closest('.item-Kegiatan').querySelector('.deskripsiContainer');
            deskripsiContainer.style.display = deskripsiContainer.style.display === 'none' ? 'block' : 'none';
        }

        function hapusSoal(button) {
            const soalItem = button.closest('.item-Kegiatan');
            soalItem.remove(); // Menghapus elemen soal
        }

        function duplikatSoal(button) {
            const soalItem = button.closest('.item-Kegiatan');
            const newSoal = soalItem.cloneNode(true); // Menggandakan elemen soal
            newSoal.querySelector('input[type="text"]').value = ''; // Mengosongkan input pertanyaan
            newSoal.querySelector('textarea').value = ''; // Mengosongkan textarea deskripsi
            const inputFields = newSoal.querySelector('#inputFields');
            inputFields.innerHTML = ''; // Mengosongkan input tambahan
            document.getElementById('soalContainer').appendChild(newSoal); // Menambahkan soal baru ke container
        }

        function showInputFields(selectElement) {
            const selectedValue = selectElement.value;
            const inputFieldsContainer = selectElement.closest('.item-Kegiatan').querySelector('#inputFields');
            inputFieldsContainer.innerHTML = ''; // Kosongkan input fields sebelumnya

            if (selectedValue === 'pilihan_ganda' || selectedValue === 'pilihan_ganda_multiple') {
                const pilihanContainer = document.createElement('div');
                pilihanContainer.className = 'pilihan-container';

                const tambahOpsiButton = document.createElement('button');
                tambahOpsiButton.type = 'button';
                tambahOpsiButton.className = 'btn btn-link';
                tambahOpsiButton.innerText = 'Tambah Opsi';
                tambahOpsiButton.onclick = function() {
                    const newOption = document.createElement('div');
                    newOption.className = 'input-group mb-2';
                    newOption.innerHTML = `
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="border: none; background: none;">
                                <input type="${selectedValue == 'pilihan_ganda' ? 'radio':'checkbox'}" name="quiz_data[${indexSoal}][pilihan][${indexPilihan}][jawaban]" class="ml-2" style="margin: 0; accent-color: blue;"/>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="quiz_data[${indexSoal}][pilihan][${indexPilihan}][opsi]" placeholder="Opsi baru" style="border: none;">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" onclick="this.parentElement.parentElement.remove();">X</button>
                        </div>
                    `;
                    pilihanContainer.insertBefore(newOption, tambahOpsiButton);
                };

                pilihanContainer.appendChild(tambahOpsiButton);
                inputFieldsContainer.appendChild(pilihanContainer);
            } else if (selectedValue === 'skala') {
                const scaleInput = document.createElement('input');
                scaleInput.type = 'number';
                scaleInput.className = 'form-control mb-2';
                scaleInput.placeholder = 'Masukkan skala (misal: 1-5)';
                inputFieldsContainer.appendChild(scaleInput);
            } else if (selectedValue === 'drop_down') {
                for (let i = 0; i < 4; i++) {
                    const inputField = document.createElement('input');
                    inputField.type = 'text';
                    inputField.className = 'form-control mb-2';
                    inputField.placeholder = `Pilihan ${i + 1}`;
                    inputFieldsContainer.appendChild(inputField);
                }
            } else if (selectedValue === 'file') {
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.className = 'form-control mb-2';
                inputFieldsContainer.appendChild(fileInput);
            }
            indexPilihan++
        }

        // function simpanPertanyaan() {
        //     const formUbahKegiatan = document.getElementById('formUbahKegiatan');
        //     const formTambahSoal = document.getElementById('formTambahSoal');

        //     const formData = new FormData(formUbahKegiatan);
        //     const soalData = new FormData(formTambahSoal);

        //     // Menggabungkan data dari kedua form
        //     soalData.forEach((value, key) => {
        //         formData.append(key, value);
        //     });

        //     // Mengambil CSRF token
        //     // const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        //     // if (!csrfTokenMeta) {
        //     //     console.error('CSRF token meta tag not found.');
        //     //     return; // Hentikan eksekusi jika tidak ada
        //     // }

        //     // Mengirim data ke server
        //     fetch('/pertanyaan/store', {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': csrfTokenMeta.getAttribute('content')
        //             }
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 alert('Pertanyaan berhasil disimpan!');
        //             } else {
        //                 alert('Gagal menyimpan pertanyaan: ' + data.message);
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             alert('Terjadi kesalahan saat menyimpan pertanyaan.');
        //         });
        // }
    </script>

    <style>
        .input-group-text {
            display: flex;
            align-items: center;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group .btn-outline-danger {
            border: none;
            color: blue;
        }
    </style>
@endsection
