<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7ff;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: #ffffff;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            padding: 2rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-bottom: none;
        }

        .card-header h2 {
            color: white;
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .quiz-details {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 1.5rem !important;
        }

        .info-box {
            background: #f8faff;
            border: 1px solid rgba(103, 126, 234, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            box-shadow: 0 5px 15px rgba(103, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .date-box {
            background: #ffffff;
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .date-box strong {
            color: #4b5563;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .date-box p {
            margin: 0.5rem 0 0;
            color: #1f2937;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .duration-box {
            background: linear-gradient(135deg, rgba(103, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
            border: 1px solid rgba(103, 126, 234, 0.2);
        }

        .duration-box strong {
            color: #4338ca;
        }

        .start-quiz-btn {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            border: none;
            padding: 1rem 2.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 12px;
            transition: all 0.3s ease;
            color: #1f2937;
            font-size: 1.1rem;
            box-shadow: 0 4px 6px rgba(132, 250, 176, 0.2);
        }

        .start-quiz-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(132, 250, 176, 0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            background: #fff3cd;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .alert-heading {
            color: #856404;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .description {
            line-height: 1.6;
            color: #4b5563;
            font-size: 1.05rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 0 15px;
            }

            .card-header {
                padding: 1.5rem 1rem;
            }

            .card-header h2 {
                font-size: 1.5rem;
            }

            .quiz-details {
                padding: 1rem !important;
            }

            .info-box {
                padding: 1rem;
            }

            .date-box {
                margin-bottom: 0.75rem;
            }

            .date-box p {
                font-size: 1rem;
            }

            .start-quiz-btn {
                width: 100%;
                padding: 0.875rem;
            }

            .duration-box {
                margin-top: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .card {
                border-radius: 15px;
            }

            .date-box {
                margin-bottom: 0.5rem;
            }

            .info-box {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-custom">
                        <h2 class="text-center">{{ $quiz->judul }}</h2>
                    </div>

                    <div class="card-body">
                        <div class="quiz-details">
                            <div class="info-box">
                                <div class="description mb-4">{!! $quiz->deskripsi !!}</div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Waktu Mulai</strong>
                                            <p>{{ \Carbon\Carbon::parse($quiz->tanggal_mulai)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="date-box">
                                            <strong>Batas Waktu</strong>
                                            <p>{{ \Carbon\Carbon::parse($quiz->tanggal_selesai)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @php
                                $startDate = \Carbon\Carbon::parse($quiz->tanggal_mulai);
                                $endDate = \Carbon\Carbon::parse($quiz->tanggal_selesai);
                                $duration = $endDate->diffInMinutes($startDate);
                                $hours = floor($duration / 60);
                                $minutes = $duration % 60;
                                @endphp

                                <div class="duration-box">
                                    <strong>Durasi Quiz:</strong>
                                    @if($hours > 0)
                                    {{ $hours }} jam
                                    @endif
                                    @if($minutes > 0)
                                    {{ $minutes }} menit
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                @php
                                $now = \Carbon\Carbon::now();
                                $endDate = \Carbon\Carbon::parse($quiz->tanggal_selesai);
                                @endphp

                                @if($now->gt($endDate) && !$attempt)
                                <div class="alert" role="alert">
                                    <h4 class="alert-heading">Quiz Telah Selesai</h4>
                                    <p class="mb-0">Batas waktu pengerjaan quiz ini telah berakhir pada {{
                                        $endDate->format('d M Y, H:i') }}.</p>
                                </div>
                                @elseif(!$attempt)
                                <form action="{{ route('exam.start', $quiz->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="start-quiz-btn">
                                        Mulai Quiz
                                    </button>
                                </form>
                                @endif

                                @if($attempt)
                                <div class="info-box">
                                    <h5 class="text-muted mb-3">Hasil Ujian</h5>
                                    @if($attempt->status == 'graded')
                                    <p>Nilai Anda: <strong>{{ $attempt->score }}</strong></p>
                                    @else
                                    <p>Ujian Anda belum dinilai.</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>