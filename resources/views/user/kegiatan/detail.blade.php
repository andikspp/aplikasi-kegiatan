@extends('layouts.default')
@section('title', 'Kegiatan Detail')
@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-custom">
                    <h2 class="text-center text-white">{{ $kegiatan->nama }}</h2>
                </div>
                <div class="card-body p-0">
                    <div class="quiz-details p-4">
                        <div class="info-box">
                            <div class="date-box mb-3">
                                <strong>Tim Kerja</strong>
                                <p>{{ $kegiatan->pokja->name }}</p>
                            </div>
                            <div class="date-box mb-3">
                                <strong>Tanggal Kegiatan</strong>
                                <p>{{ date('d M Y', strtotime($kegiatan->tanggal_kegiatan)) }} - {{ date('d M Y', strtotime($kegiatan->tanggal_selesai)) }}</p>
                            </div>
                            <div class="date-box mb-3">
                                <strong>Tempat Kegiatan</strong>
                                <p>{{ $kegiatan->tempat_kegiatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($kegiatan->link_meeting)
                <div class="duration-box mb-3">
                    <strong class="d-block mb-2 text-center">Link Meeting</strong>
                    <a href="{{ $kegiatan->link_meeting }}" target="_blank" class="d-block text-center text-truncate" style="
                        color: #4338ca; 
                        text-decoration: none; 
                        overflow: hidden; 
                        white-space: nowrap; 
                        text-overflow: ellipsis;
                        max-width: 100%;
                        font-weight: 500;">
                        {{ $kegiatan->link_meeting }}
                    </a>
                </div>
                @endif
                <div class="text-center mt-4">
                    @php
                    $now = \Carbon\Carbon::now();
                    $pendaftaranMulai = \Carbon\Carbon::parse($kegiatan->tanggal_pendaftaran);
                    $pendaftaranSelesai = \Carbon\Carbon::parse($kegiatan->selesai_pendaftaran);
                    @endphp
                    @if ($now < $pendaftaranMulai)
                    <div class="alert" style="background: #fff3cd; border: none; border-radius: 12px;" role="alert">
                        <p class="mb-0 text-muted">Pendaftaran Belum Dibuka</p>
                    </div>
                    @elseif ($now > $pendaftaranSelesai)
                    <div class="alert" style="background: #f8d7da; border: none; border-radius: 12px;" role="alert">
                        <p class="mb-0 text-muted">Pendaftaran Telah Ditutup</p>
                    </div>
                    @else
                    <a href="{{ route('kegiatan.daftar', $kegiatan->id) }}" class="daftar-btn">Daftar Kegiatan</a>
                    @endif
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
    .date-box {
        background: #f8faff;
        border: 1px solid rgba(103, 126, 234, 0.1);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
    }
    .date-box strong {
        display: block;
        color: #4b5563;
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    .date-box p {
        color: #1f2937;
        font-weight: 500;
        margin: 0;
    }
    .daftar-btn {
        background-color: #0090D4;
        border: none;
        padding: 1rem 2.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 12px;
        transition: all 0.3s ease;
        color: #ffffff;
        font-size: 1.1rem;
        box-shadow: 0 4px 6px rgba(132, 250, 176, 0.2);
        display: inline-block;
        text-decoration: none;
    }
    .daftar-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(132, 250, 176, 0.3);
    }
    .info-box {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 1rem;
    }
</style>
@endsection