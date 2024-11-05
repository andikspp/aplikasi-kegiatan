@extends('layouts.menu.layout-dashboard')
@section('title', 'QR Code Generator')


@section('content')
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg main-navbar">
            <!-- ... existing navbar code ... -->
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <!-- ... existing sidebar code ... -->
            </aside>
        </div>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>QR Generator</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">QR Generator</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-8 mx-auto text-center">
                                        <input type="text" class="form-control mb-2" id="url"
                                            placeholder="Masukkan tautan" required>
                                        <button class="btn btn-primary btn-sm" id="generate-btn"><i
                                                class="fas fa-qrcode"></i> Generate</button>
                                    </div>
                                    <div class="col-12 text-center mt-3 d-none" id="img-container">
                                        <img src="" id="img-result" width="320px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const urlInput = $('#url');
            const imgResult = $('#img-result');
            const imgContainer = $('#img-container');
            const generateBtn = $('#generate-btn');

            generateBtn.on('click', function() {
                const urlValue = urlInput.val();
                if (urlValue) {
                    imgContainer.removeClass('d-none');
                    imgResult.attr('src',
                        `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(urlValue)}&size=200x200`
                        );
                } else {
                    alert("Silakan masukkan tautan yang valid.");
                }
            });
        });
    </script>
@endsection

@push('styles')
    <style>
        .main-wrapper {
            margin-top: 50px;
        }

        .card {
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
