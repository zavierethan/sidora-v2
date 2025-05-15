@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Edit
    </h2>
    <div class="intro-y box col-span-12 lg:col-span-6 mt-5">
        <div id="vertical-form" class="p-5">
            <form class="preview" action="{{route('master.sarana.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="vertical-form-1" class="sm:w-40 font-bold">Nama</label>
                    <input type="text" name="nama" class="form-control mt-2" value="{{$data->nama}}">
                    <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                </div>
                <div class="mt-3 text-right">
                    <a href="{{route('master.sarana.index')}}" class="btn btn-danger mt-5">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-5">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
