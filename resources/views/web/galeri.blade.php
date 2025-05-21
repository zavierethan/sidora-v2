@extends('layouts._base')

@section('content')
<div class="container-fluid pt-5 bg-primary hero-header">
    <div class="container pt-5">
        <div class="row g-5 pt-5">
            <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5">
                <h1 class="display-4 text-white mb-4 animated slideInRight">Galeri Kegiatan</h1>
                <p class="text-white mb-4 animated slideInRight">Informasi mengenai kegiatan keolahragaan di wilayah Kabupaten Bandung</p>
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
            <h1 class="mb-4">Galeri Kegiatan</h1>
        </div>
        <div class="row g-4">
            @foreach($data as $item)
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="case-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="data:image/png;base64,{{$item->content}}" alt="" style="width: 600px; height: 500px;">
                    <a class="case-overlay text-decoration-none" href="">
                        <h5 class="lh-base text-white mb-3">{{$item->title}}</h5>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Centered Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
