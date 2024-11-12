<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* body {
            background-color: #005689;
        } */

        .card {
            border-radius: 20px;
        }

        .card-header {
            margin-bottom: 20px;
        }

        #register {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-header text-center">
                    <img src="{{ asset('assets/logo kemendikbudristek.png') }}" alt="Logo" class="img-fluid mb-3"
                        style="max-width: 150px;">
                </div>
                <div class="card">
                    <h3 class="text-center" style="margin-top:20px;">Register</h3>
                    <div class="card-body">
                        <form action="{{ route('user.register.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required
                                    autofocus>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required
                                    autofocus>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required
                                    autofocus>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3"
                                style="background-color: #005689">Daftar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
