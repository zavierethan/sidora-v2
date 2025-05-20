@extends('layouts._base')

@section('content')
<!-- Hero Start -->
<div class="container-fluid pt-5 bg-primary hero-header mb-5">
    <div class="container pt-5">
        <div class="row g-5 pt-5">
            <div class="col-lg-8 align-self-center text-center text-lg-start mb-lg-5">
                <div class="btn btn-sm border rounded-pill text-white px-3 mb-3 animated slideInRight">SIDORA BEDAS
                </div>
                <h1 class="display-4 text-white mb-4 animated slideInRight">Sistem Data Keolahragaan</h1>
                <p class="text-white mb-4 animated slideInRight">Dinas Pemuda dan Olahraga Kabupaten Bandung</p>
            </div>
            <div class="col-lg-6 align-self-end text-center text-lg-end">
                <!-- <img class="img-fluid" src="{{asset('assets/web/img/bedas.jpg')}}" alt=""> -->
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Full Screen Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(20, 24, 62, 0.7);">
            <div class="modal-header border-0">
                <button type="button" class="btn btn-square bg-white btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <div class="input-group" style="max-width: 600px;">
                    <input type="text" class="form-control bg-transparent border-light p-3"
                        placeholder="Type search keyword">
                    <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Full Screen Search End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img">
                    <img class="img-fluid" src="{{asset('assets/images/logo_sidora_new.png')}}">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Tentang</div>
                <h1 class="mb-4">Apa Itu SIDORA ?</h1>
                <p class="mb-4" style="text-align: justify;">SIDORA (Sistem Data Keolahragaan) adalah sistem
                    informasi yang di launching
                    oleh Dinas Pemuda dan Olahraga Kabupaten Bandung. Sistem ini menyajikan informasi
                    mengenai data keolahragaan yang meliputi data sarana, prasarana, kegiatan olahraga di masyarakat
                    dan prestasi atlet.</p>
                <p class="mb-4" style="text-align: justify;">SIDORA muncul sebagai tonggak inovatif yang dirilis
                    oleh Dinas Pemuda dan Olahraga
                    Kabupaten Bandung untuk mengoptimalkan pengelolaan dan diseminasi informasi di ranah
                    keolahragaan. Platform ini dirancang dengan cermat untuk menyajikan data yang komprehensif dan
                    relevan terkait dengan kegiatan olahraga di wilayah Kabupaten Bandung.</p>
                <div class="d-flex align-items-center mt-4">
                    <a class="btn btn-outline-primary btn-square me-3" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square me-3" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square me-3" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Service Start -->
<div class="container-fluid bg-light mt-5 py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Data Keolahragaan</div>
                <h1 class="mb-4">Fitur SIDORA</h1>
                <p class="mb-4" style="text-align: justify;">
                    SIDORA memberikan sumber informasi terkini dan akurat seputar sarana, prasarana,
                    kegiatan olahraga, dan prestasi atlet di wilayah Kabupaten Bandung.
                </p>
                <a class="btn btn-primary rounded-pill px-4" href="">Read More</a>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                                <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                    <div class="service-icon btn-square">
                                        <i class="fa fa-robot fa-2x"></i>
                                    </div>
                                    <h5 class="mb-3">Infrastruktur Olahraga</h5>
                                    <p>
                                        Memberikan gambaran lengkap tentang fasilitas olahraga yang tersedia di
                                        Kabupaten Bandung.
                                    </p>
                                    <a class="btn px-3 mt-auto mx-auto" href="{{route('infografis')}}">Read More</a>
                                </div>
                            </div>
                            <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                    <div class="service-icon btn-square">
                                        <i class="fa fa-power-off fa-2x"></i>
                                    </div>
                                    <h5 class="mb-3">Olahraga Masyarakat</h5>
                                    <p>Memberikan wawasan tentang kegiatan olahraga yang berlangsung di masyarakat.
                                    </p>
                                    <a class="btn px-3 mt-auto mx-auto" href="{{route('olahraga.masyarakat')}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pt-md-4">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                    <div class="service-icon btn-square">
                                        <i class="fa fa-graduation-cap fa-2x"></i>
                                    </div>
                                    <h5 class="mb-3">Olahraga Prestasi</h5>
                                    <p>Menyajikan informasi terkait dengan infrastruktur olahraga, mencakup
                                        fasilitas yang mendukung pengembangan kegiatan olahraga di wilayah tersebut.
                                    </p>
                                    <a class="btn px-3 mt-auto mx-auto" href="{{route('olahraga.prestasi')}}">Read More</a>
                                </div>
                            </div>
                            <div class="col-12 wow fadeIn" data-wow-delay="0.7s">
                                <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                    <div class="service-icon btn-square">
                                        <i class="fa fa-brain fa-2x"></i>
                                    </div>
                                    <h5 class="mb-3">Galeri Kegiatan</h5>
                                    <p>menyajikan data terbaru seputar prestasi atlet dan pencapaian pelatih di
                                        Kabupaten Bandung.</p>
                                    <a class="btn px-3 mt-auto mx-auto" href="{{route('galeri')}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Feature Start -->
<div class="container-fluid bg-white py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s">
            <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Infografis</div>
            <h1 class="mb-4">Infografis</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 align-self-center mb-md-5 pb-md-5 wow fadeIn" data-wow-delay="0.3s">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->

<!-- Case Start -->
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Kegiatan</div>
            <h1 class="mb-4">Galeri Kegiatan</h1>
        </div>
        <div class="row g-4">
            @foreach($galeri as $item)
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="data:image/png;base64,{{$item->content}}" alt="" style="width: 600px; height: 500px;">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Robotic Automation</small>
                        <h5 class="lh-base text-white mb-3">{{$item->title}}
                        </h5>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Case End -->
@endsection

@section('script')

<script>
$(document).ready(function() {

    $.ajax({
        url: '/api/v1/infrastruktur-olahraga/get-summary-data-kelolahragaan',
        method: 'GET',
        dataType: 'json',
            success: function(response) {
                // Handle the response data
                console.log(response.data);
                renderMap(response.data);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(status, error);
            }
    });
});


function renderMap(data) {
    var map = L.map('map').setView([-7.021896552663677, 107.5277945169024], 11); // Koordinat pusat peta

    // Tambahkan layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Tambahkan marker untuk setiap kecamatan
    data.forEach(function(item) {
      var marker = L.marker([item.latitude, item.longitude]).addTo(map);
      var popup_string =`<div>
                            <b>Kecamatan:</b> ${item.kecamatan} <br><b>Fasilitas Olahraga:</b> ${item.sarana} <br><b>Kelompok Olahraga:</b> ${item.kelompok_olahraga}
                        </div>`;
      marker.bindPopup(popup_string).openPopup();
    });
}
</script>
@endsection
