@extends('layouts._base')

@section('content')
<div class="container-fluid pt-5 bg-primary hero-header">
    <div class="container pt-5">
        <div class="row g-5 pt-5">
            <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5">
                <h1 class="display-4 text-white mb-4 animated slideInRight">Kegiatan</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Testimonial</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 align-self-end text-center text-lg-end">
                <img class="img-fluid" src="img/hero-img.png" alt="" style="max-height: 300px;">
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="mb-4">Kegiatan Terkini</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="{{asset('assets/web/img/project-1.jpg')}}" alt="">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Robotic Automation</small>
                        <h5 class="lh-base text-white mb-3">Lorem elitr magna stet eirmod labore amet labore clita
                        </h5>
                        <span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="{{asset('assets/web/img/project-2.jpg')}}" alt="">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Machine learning</small>
                        <h5 class="lh-base text-white mb-3">Lorem elitr magna stet eirmod labore amet labore clita
                        </h5>
                        <span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.7s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="{{asset('assets/web/img/project-3.jpg')}}" alt="">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Predictive Analysis</small>
                        <h5 class="lh-base text-white mb-3">Lorem elitr magna stet eirmod labore amet labore clita
                        </h5>
                        <span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="{{asset('assets/web/img/project-1.jpg')}}" alt="">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Robotic Automation</small>
                        <h5 class="lh-base text-white mb-3">Lorem elitr magna stet eirmod labore amet labore clita
                        </h5>
                        <span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="{{asset('assets/web/img/project-2.jpg')}}" alt="">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Machine learning</small>
                        <h5 class="lh-base text-white mb-3">Lorem elitr magna stet eirmod labore amet labore clita
                        </h5>
                        <span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.7s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="{{asset('assets/web/img/project-3.jpg')}}" alt="">
                    <a class="case-overlay text-decoration-none" href="">
                        <small>Predictive Analysis</small>
                        <h5 class="lh-base text-white mb-3">Lorem elitr magna stet eirmod labore amet labore clita
                        </h5>
                        <span class="btn btn-square btn-primary"><i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
