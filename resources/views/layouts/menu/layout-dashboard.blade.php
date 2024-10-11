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
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </div>
            </div>

            <div class="menu-section">
                <div class="section-heading text-uppercase fw-bold py-2 ps-3">Agenda</div>
                <div class="list-group list-group-flush my-3">
                    <a href="{{ route('kegiatan') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-calendar-alt me-2"></i> Kegiatan
                    </a>

                    <a href="{{ route('peserta') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i> Biodata Peserta
                    </a>

                    <a href="{{ route('qrcode') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-qrcode me-2"></i> QR Code
                    </a>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <div id="overlay"></div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom">
                <!-- Icon Sidebar and Search for Mobile -->
                <div class="d-flex">
                    <!-- Sidebar Toggle Icon -->
                    <button class="btn bg-custom text-white" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Search Icon (Mobile) -->
                    <button class="btn btn-success ms-2 d-lg-none" type="button" id="mobile-search-toggle">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Search Input for Larger Screens (Hidden on Mobile) -->
                <form class="d-none d-lg-flex me-auto ms-4" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
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

            <!-- Modal-like Search Input -->
            <div class="modal-search" id="modal-search-box">
                <form class="d-flex" role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <!-- Footer -->
    <footer class="bg-custom text-white text-center text-lg-start custom-footer">
        <div class="text-center p-3">
            © 2024 Guru PAUD Dikmas | All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('mobile-search-toggle').addEventListener('click', function() {
            var searchBox = document.getElementById('modal-search-box');

            searchBox.classList.toggle('show');

            if (searchBox.classList.contains('show')) {
                searchBox.style.top = '0';
            }
        });

        document.addEventListener('click', function(event) {
            var searchBox = document.getElementById('modal-search-box');
            var toggleButton = document.getElementById('mobile-search-toggle');

            if (!searchBox.contains(event.target) && !toggleButton.contains(event.target)) {
                searchBox.classList.remove('show');
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById("menu-toggle");
            const sidebar = document.getElementById("sidebar-wrapper");
            const overlay = document.getElementById("overlay");

            menuToggle.addEventListener("click", function() {
                sidebar.classList.toggle("active");
                overlay.classList.toggle("active");
            });

            overlay.addEventListener("click", function() {
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            });
        });
    </script>

    <style>
        #wrapper {
            display: flex;
        }

        #sidebar-wrapper {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 250px;
            z-index: 1000;
            background-color: #f8f9fa;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            border-right: 1px solid #ddd;
        }

        #sidebar-wrapper.active {
            transform: translateX(0);
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 900;
            display: none;
        }

        #overlay.active {
            display: block;
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .section-heading {
            font-size: 1rem;
            color: #343a40;
            background-color: transparent;
            padding-left: 10px;
            opacity: 0.8;
        }

        #page-content-wrapper {
            flex: 1;
            transition: all 0.3s ease;
        }

        .toggled #sidebar-wrapper {
            margin-left: -250px;
        }

        .bg-custom {
            background-color: #0090D4;
        }

        .heading-dashboard {
            background-color: transparent;
            color: #343a40;
        }

        .heading-agenda {
            background-color: transparent;
            color: #343a40;
            opacity: 0.8;
        }

        .list-group-item {
            padding: 15px 20px;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
            color: #000;
        }

        .sidebar-heading {
            font-size: 1.2rem;
            background-color: #0090D4;
            color: #fff;
            padding: 10px;
        }

        #mobile-search-box {
            height: 0;
            opacity: 0;
            visibility: hidden;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        #mobile-search-box.show {
            height: auto;
            opacity: 1;
            visibility: visible;
            transition: all 0.3s ease-in-out;
        }

        .modal-search {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            z-index: 1000;
            transition: top 0.3s ease-in-out;
        }

        .modal-search.show {
            display: block;
        }

        .custom-footer {
            margin-top: 100px;
            padding: 20px 0;
        }
    </style>
</body>

</html>
