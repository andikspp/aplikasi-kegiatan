@extends('layouts.default')

@section('title', 'Kegiatan Tidak Ditemukan')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-custom">
                    <h2 class="text-center text-white">Kegiatan Tidak Ditemukan</h2>
                </div>
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                            stroke="#0090D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-alert-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <h3 class="mb-3">Maaf, Kegiatan yang Anda cari tidak tersedia</h3>
                    <p class="text-muted mb-4">
                        Kegiatan mungkin telah dihapus, belum dibuat, atau tidak dapat diakses.
                    </p>
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

    .card-header {
        padding: 1rem;
    }
</style>
@endsection