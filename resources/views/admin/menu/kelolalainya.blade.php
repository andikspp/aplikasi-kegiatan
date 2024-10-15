@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
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
@endsection