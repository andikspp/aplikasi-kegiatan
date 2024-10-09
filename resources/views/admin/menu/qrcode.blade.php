@extends('layouts.menu.layout-dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">QR Generator</div>

                    <div class="card-body">
                        <form action="{{ route('qrcode') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="url" placeholder="Masukan tautan"
                                    required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-qrcode mr-2"></i> Generate
                                </button>
                            </div>
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
            border-radius: 0;
        }

        .btn-primary {
            border-radius: 0;
        }
    </style>
@endpush
