@extends('layouts.menu.layout-dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Total Kegiatan -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-primary text-white mb-4">
                    <div class="card-body">
                        <a href="{{ route('kegiatan') }}" class="text-white">
                            <h5 class="card-title">
                                <i class="fas fa-calendar-alt fa-2x"></i> <!-- Ikon Font Awesome -->
                                <br>Total Kegiatan
                            </h5>
                            <p class="card-text mt-3">
                                <strong>{{ $totalKegiatan }}</strong> <!-- Data total kegiatan -->
                            </p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Kegiatan Mendatang -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-warning text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-day fa-2x"></i> <!-- Ikon Font Awesome -->
                            <br>Kegiatan Mendatang
                        </h5>
                        <p class="card-text mt-3">
                            <strong>{{ $kegiatanMendatang }}</strong> <!-- Data kegiatan mendatang -->
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Kegiatan Selesai -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-success text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-check-circle fa-2x"></i> <!-- Ikon Font Awesome -->
                            <br>Kegiatan Selesai
                        </h5>
                        <p class="card-text mt-3">
                            <strong>{{ $kegiatanSelesai }}</strong> <!-- Data kegiatan selesai -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-danger text-white mb-4">
                    <div class="card-body">
                        <a href="{{ route('kegiatan') }}" class="text-white">
                            <h5 class="card-title">
                                <i class="fas fa-user fa-2x mb-2"></i> <!-- Ikon Font Awesome -->
                                <br>Jumlah Peserta
                            </h5>
                            <p class="card-text mt-3">
                                <strong>{{ $jumlahPeserta }}</strong> <!-- Data kegiatan selesai -->
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-success text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-users fa-2x mb-2"></i> <!-- Ikon Font Awesome -->
                            <br>Jumlah Peserta Daftar
                        </h5>
                        <p class="card-text mt-3">
                            <strong>{{ $jumlahPesertaDaftar }}</strong> <!-- Data kegiatan selesai -->
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-primary text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-pen fa-2x mb-2"></i> <!-- Ikon Font Awesome -->
                            <br>Jumlah Kuis Tersedia
                        </h5>
                        <p class="card-text mt-3">
                            <strong>{{ $jumlahkuis }}</strong> <!-- Data kegiatan selesai -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
