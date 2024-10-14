@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Kelola Quiz</div>

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
                                <div class="col-md-6">
                                    <label for="tanggal_mulai">Tanggal Quiz * - Mulai</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_mulai"
                                        name="tanggal_mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_selesai">Selesai</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_selesai"
                                        name="tanggal_selesai" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="syarat_unduh">Syarat untuk mengunduh sertifikat</label>
                                <select class="form-control" id="syarat_unduh" name="syarat_unduh">
                                    <option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
                                </select>
                            </div>

                            <div class="item-quiz mt-4">
                                <h5>Item Quiz</h5>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="text" class="form-control mr-2" placeholder="Pertanyaan" style="flex-grow: 1;">
                                    <select class="form-control ml-2" style="width: 150px;">
                                        <option>Essai</option>
                                        <!-- Tambahkan opsi lain jika diperlukan -->
                                    </select>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-success mr-2"><i class="fas fa-arrow-down"></i></button>
                                    <button type="button" class="btn btn-primary mr-2"><i class="fas fa-copy"></i></button>
                                    <button type="button" class="btn btn-danger mr-2"><i class="fas fa-trash"></i></button>
                                    <div class="custom-control custom-switch ml-2">
                                        <input type="checkbox" class="custom-control-input" id="wajibDiisi">
                                        <label class="custom-control-label" for="wajibDiisi">Wajib diisi</label>
                                    </div>
                                    <button type="button" class="btn btn-link ml-auto"><i class="fas fa-ellipsis-v"></i></button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Tambah Item
                            </button>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
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

        .form-control {
            border-radius: 4px;
        }

        .btn-primary {
            border-radius: 4px;
        }

        .item-quiz {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }

        .btn-success, .btn-primary, .btn-danger {
            padding: 5px 10px;
        }

        .custom-switch {
            padding-left: 2.25rem;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: '#deskripsi',
            plugins: 'link lists',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link',
            menubar: false,
        });
    </script>
@endpush