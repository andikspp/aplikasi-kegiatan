<!-- resources/views/layouts/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <!-- Heading utama untuk sidebar -->
            <div
                class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom heading-dashboard">
                Guru PAUD Dikmas
            </div>

            <!-- Div Dashboard: Menandakan menu Dashboard -->
            <div class="menu-section">
                <div class="section-heading text-uppercase fw-bold py-2 ps-3">Dashboard</div>
                <!-- Penanda untuk div Dashboard -->
                <div class="list-group list-group-flush my-3">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </div>
            </div>

            <div class="menu-section">
                <div class="section-heading text-uppercase fw-bold py-2 ps-3">Agenda</div>
                <div class="list-group list-group-flush my-3">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-calendar-alt me-2"></i> Kegiatan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-qrcode me-2"></i> QR Code
                    </a>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom">
                <button class="btn bg-custom text-white" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <form class="d-flex me-auto ms-4" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto me-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> Hi, Nama Akun
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <!-- Bootstrap and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script to toggle sidebar -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    <style>
        #wrapper {
            display: flex;
        }

        #sidebar-wrapper {
            width: 250px;
            height: 100%;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .section-heading {
            font-size: 1rem;
            color: #343a40;
            background-color: transparent;
            /* Tidak ada background */
            padding-left: 10px;
            opacity: 0.8;
        }

        #page-content-wrapper {
            flex: 1;
        }

        .toggled #sidebar-wrapper {
            margin-left: -250px;
        }

        .bg-custom {
            background-color: #0090D4;
        }

        .heading-dashboard {
            background-color: transparent;
            /* Transparan */
            color: #343a40;
            /* Warna teks */
        }

        .heading-agenda {
            background-color: transparent;
            /* Transparan untuk Agenda */
            color: #343a40;
            /* Warna teks */
            opacity: 0.8;
            /* Efek transparan */
        }

        .list-group-item {
            padding: 15px 20px;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
            /* Efek hover pada menu */
            color: #000;
        }

        .sidebar-heading {
            font-size: 1.2rem;
            background-color: #0090D4;
            /* Warna header sidebar */
            color: #fff;
            padding: 10px;
        }
    </style>
</body>

</html>
