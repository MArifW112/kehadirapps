<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            display: flex;
            align-items: baseline
            justify-content: left;
        }
        .header .img {
            width: auto;
            height: auto;
        }
        .navbar {
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .navbar-brand i {
            margin-right: 8px;
            font-size: 1.5rem;
            color: #3268B0;
        }
        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
        }
        .navbar-nav .nav-link i {
            margin-right: 8px;
            font-size: 1.5rem;
            color: #3268B0;
        }
        {box-sizing: border-box;}
    </style>
</head>
<body>
    <div class="header" >
        <img src="{{ asset('images/Logo.png') }}" alt="Logo">
        <h1>KEHADIR-APPS</h1>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f9f9f9;">
        <div class="container-fluid">
            <a class="navbar-brand" id="dashboard-link" href="{{ url('home') }}">
                <i class="bi bi-house-door-fill"></i> 
                Home
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" id="izin-link" href="{{ url('pengajuan') }}">
                            <i class="bi bi-envelope-check"></i> Daftar Pengajuan Izin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="absensi-link" href="{{ url('laporan') }}">
                            <i class="bi bi-file-earmark-fill"></i> Log Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="jam-link" href="{{ url('karyawan') }}">
                            <i class="bi bi-people-fill"></i> Detail Karyawan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="libur-link" href="{{ url('libur') }}">
                            <i class="bi bi-calendar-event"></i> Hari Libur
                        </a>
                    </li>
                
                <ul class="navbar-nav ms-auto">
                    @if (Auth::check())
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="display: flex; align-items: center;">
                                    <i class="bi bi-box-arrow-right" style="margin-right: 8px;"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right" style="margin-right: 8px;"></i> Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    

    <div class="container">
        @yield('content')
    </div>
    <script>
        // Fungsi untuk menambahkan garis bawah berdasarkan URL
        function highlightNavbar() {
            // Mendapatkan URL saat ini
            const currentUrl = window.location.pathname;
    
            // Daftar link navbar dengan ID
            const links = {
                '/home': 'dashboard-link',
                '/pengajuan': 'izin-link',
                '/laporan': 'absensi-link',
                '/jenis': 'jenis-link',
                '/jam': 'jam-link',
                '/libur': 'libur-link'

            };
    
            // Loop melalui daftar link dan tambahkan border-bottom ke yang cocok
            for (const path in links) {
                if (currentUrl.includes(path)) {
                    document.getElementById(links[path]).style.borderBottom = '3px solid #3268B0';
                }
            }
        }
    
        // Panggil fungsi setelah halaman dimuat
        window.onload = highlightNavbar;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
