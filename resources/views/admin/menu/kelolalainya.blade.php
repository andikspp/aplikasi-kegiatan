@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <a href="{{ route('hasilkegiatan') }}" class="btn btn-link">Kelola Kegiatan</a>
            <a href="{{ route('kelolapeserta') }}" class="btn btn-link">Kelola Peserta</a>
            <a href="{{ route('kelolalainnya') }}" class="btn btn-primary me-2">Kelola Lainnya</a>
        </div>

            <div class="d-flex mb-4 bg-light p-3">
            <h1 class="mb-4">Kelola Lainnya</h1>
            <ul class="list-unstyled">
                <li>
                    <a href="#" class="text-decoration-none">
                        <span class="text-success">📥</span> Unduh Presensi
                    </a>
                </li>
                <li>
                    <a href="#" class="text-decoration-none">
                        <span class="text-success">📥</span> Unduh Biodata
                    </a>
                </li>
                <li>
                    <a href="#" class="text-decoration-none">
                        <span class="text-success">📥</span> Unduh Sertifikat
                    </a>
                </li>
                <li>
                    <a href="#" class="text-success text-decoration-none">
                        <span class="text-primary">📤</span> Unggah Ajukan SK Sertifikat
                    </a>
                </li>
                <li>
                    <a href="#" class="text-danger text-decoration-none">
                        <span class="text-danger">📊</span> Sebaran Peserta
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
