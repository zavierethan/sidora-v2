@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Edit
    </h2>
    <div class="intro-y box col-span-12 lg:col-span-6 mt-5">
        <div id="vertical-form" class="p-5">
            <form class="preview" action="{{route('master.kecamatan.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="vertical-form-1" class="form-label">Kode</label>
                    <input id="vertical-form-1" type="text" name="title" value="{{$data->kode}}" class="form-control">
                    <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Nama</label>
                    <input id="vertical-form-2" type="text" name="meta_title" value="{{$data->nama}}" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-1" class="form-label">Latitude</label>
                    <input id="vertical-form-1" type="text" name="title" value="{{$data->latitude}}" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Longitude</label>
                    <input id="vertical-form-2" type="text" name="meta_title" value="{{$data->longitude}}" class="form-control">
                </div>
                <div class="mt-3 text-right">
                    <a href="{{route('master.kecamatan.index')}}" class="btn btn-danger mt-5">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-5">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
