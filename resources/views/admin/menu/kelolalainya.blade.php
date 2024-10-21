@extends('layouts.menu.layout-dashboard')

@section('content')
<div class="container mt-5">
        <div class="d-flex mb-4 bg-light p-3">
            <a href="{{ route('hasilkegiatan') }}" class="btn btn-link">
                <i class="fas fa-calendar"></i> Kelola Kegiatan
            </a>
            <a href="{{ route('kelolapeserta') }}" class="btn btn-link">
                <i class="fas fa-users"></i> Kelola Peserta
            </a>
            <a href="{{ route('kelolalainnya') }}" class="btn btn-primary me-2">
                <i class="fas fa-cogs"></i> Kelola Lainnya
            </a>
        </div>

    <form id="formUbahKegiatan" class="bg-light p-4 rounded shadow">
        <h1 class="mb-4" style="font-size: larger;">Kelola Lainnya</h1>
        <ul class="list-unstyled">
            <li>
                <a href="#" class="text-decoration-none">
                    <span class="text-success">📥</span> 1. Unduh Presensi
                </a>
            </li>
            <li>
                <a href="#" class="text-decoration-none">
                    <span class="text-success">📥</span> 2. Unduh Biodata
                </a>
            </li>
            <li>
                <a href="#" class="text-decoration-none">
                    <span class="text-success">📥</span> 3. Unduh Sertifikat
                </a>
            </li>
            <li>
                <a href="#" class="text-success text-decoration-none">
                    <span class="text-primary">📤</span> 4. Unggah Ajukan SK Sertifikat
                </a>
            </li>
            <li>
                <a href="#" class="text-danger text-decoration-none">
                    <span class="text-danger">📊</span> 5. Sebaran Peserta
                </a>
            </li>
        </ul>
    </form>
</div>
@endsection
