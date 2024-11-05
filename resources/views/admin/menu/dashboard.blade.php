@extends('layouts.menu.layout-dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Total Kegiatan -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm bg-primary text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-alt fa-2x"></i> <!-- Ikon Font Awesome -->
                            <br>Total Kegiatan
                        </h5>
                        <p class="card-text mt-3">
                            <strong>{{ $totalKegiatan }}</strong> <!-- Data total kegiatan -->
                        </p>
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
    </div>
@endsection
