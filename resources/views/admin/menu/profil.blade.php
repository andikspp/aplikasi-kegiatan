@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container mt-5">
        <h1>Profil Pengguna</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-user fa-2x"></i> <!-- Ikon Font Awesome -->
                            <br>Nama: {{ $user->name }}
                        </h5>
                        <p class="card-text mt-3">
                            <strong>Email: {{ $user->email }}</strong>
                        </p>
                        <p class="card-text mt-3">
                            <strong>Tanggal Bergabung: {{ $user->created_at->format('d-m-Y') }}</strong>
                        </p>
                        {{-- Tambahkan informasi lain yang relevan di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection