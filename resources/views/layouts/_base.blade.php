<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIDORA - Sistem Data Keolahrgaan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="https://sidora.bandungkab.go.id/assets/images/logo_sidora_new.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Ubuntu:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- <link href="https://sidora.bandungkab.go.id/assets/web/lib/animate/animate.min.css" rel="stylesheet"> -->
    <link href="{{asset('assets/web/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="https://sidora.bandungkab.go.id/assets/web/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://sidora.bandungkab.go.id/assets/web/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="https://sidora.bandungkab.go.id/assets/web/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    @yield('style')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-primary position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a href="/" class="navbar-brand">
                    <img alt="SIDORA BEDAS" style="width: 120px;"
                        src="https://sidora.bandungkab.go.id/assets/images/logo_sidora_new.png">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{route('index')}}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                        <a href="{{route('infografis')}}" class="nav-item nav-link {{ request()->is('infrastruktur-keolahragaan') ? 'active' : '' }}">Infrastruktur Keolahragaan</a>
                        <a href="{{route('olahraga.prestasi')}}" class="nav-item nav-link {{ request()->is('olahraga-prestasi') ? 'active' : '' }}">Olahraga Prestasi</a>
                        <a href="{{route('olahraga.masyarakat')}}" class="nav-item nav-link {{ request()->is('olahraga-masyarakat') ? 'active' : '' }}">Olahraga Masyarakat</a>
                        <!-- <a href="{{route('kegiatan')}}" class="nav-item nav-link {{ request()->is('kegiatan') ? 'active' : '' }}">Kegiatan</a> -->
                        <a href="{{route('galeri')}}" class="nav-item nav-link {{ request()->is('galeri') ? 'active' : '' }}">Galeri Kegiatan</a>
			<a href="{{route('login')}}" class="nav-item nav-link ml-5">Login</a>
                    </div>
                    <!--  -->
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-primary text-white-50 footer pt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <a href="/" class="d-inline-block mb-3">
                        <img alt="SIDORA BEDAS" style="width: 120px;"
                            src="https://sidora.bandungkab.go.id/assets/images/logo_sidora_new.png">
                    </a>
                    <p class="mb-0">
                        SIDORA (Sistem Data Keolahragaan) adalah sistem informasi yang di launching oleh Dinas
                        Pemuda dan Olahraga Kabupaten Bandung.
                    </p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <h5 class="text-white mb-4">Get In Touch</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Pamekaran, Soreang, Bandung Regency, West Java 40912</p>
                    <p><i class="fa fa-phone-alt me-3"></i>(022) 5895643</p>
                    <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <h5 class="text-white mb-4">Popular Link</h5>
                    <a class="btn btn-link" href="{{route('index')}}">Beranda</a>
                    <a class="btn btn-link" href="{{route('infografis')}}">Infrastruktur Keolahragaan</a>
                    <a class="btn btn-link" href="{{route('olahraga.prestasi')}}">Olahraga Prestasi</a>
                    <a class="btn btn-link" href="{{route('olahraga.masyarakat')}}">Olahraga Masyarakat</a>
                    <a class="btn btn-link" href="{{route('galeri')}}">Galeri Kegiatan</a>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <h5 class="text-white mb-4">Data Keolahragaan</h5>
                    <a class="btn btn-link" href="">Data Sarana & Prasarana</a>
                    <a class="btn btn-link" href="">Data Kegiatan Keolahragaan </a>
                    <a class="btn btn-link" href="">Data Olaharaga Prestasi</a>
                    <a class="btn btn-link" href="">Data Olahraga Masyarakat</a>
                </div>
            </div>
        </div>
        <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">SIDORA Kabupaten Bandung</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://sidora.bandungkab.go.id/assets/web/lib/wow/wow.min.js"></script>
    <script src="https://sidora.bandungkab.go.id/assets/web/lib/easing/easing.min.js"></script>
    <script src="https://sidora.bandungkab.go.id/assets/web/lib/waypoints/waypoints.min.js"></script>
    <script src="https://sidora.bandungkab.go.id/assets/web/lib/counterup/counterup.min.js"></script>
    <script src="https://sidora.bandungkab.go.id/assets/web/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="https://sidora.bandungkab.go.id/assets/web/js/main.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @yield('script')
</body>

</html>
