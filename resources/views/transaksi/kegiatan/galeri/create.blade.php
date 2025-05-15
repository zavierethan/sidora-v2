@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Form
    </h2>
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-octagon" data-lucide="alert-octagon" class="lucide lucide-alert-octagon w-6 h-6 mr-2">
            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg> {{ session('error') }}
        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x"
                data-lucide="x" class="lucide lucide-x w-4 h-4">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg> </button>
    </div>
    @endif
    <div class="intro-y box col-span-12 lg:col-span-6 mt-5">
        <div id="vertical-form" class="p-5">
            <form class="preview" action="{{route('kegiatan.galeri.save')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="vertical-form-1" class="form-label">Title</label>
                    <input id="vertical-form-1" type="text" name="title" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Meta Title</label>
                    <input id="vertical-form-2" type="text" name="meta_title" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Content</label>
                    <input id="vertical-form-2" type="file" name="content" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Date</label>
                    <input id="vertical-form-2" type="date" name="date" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Summary</label>
                    <textarea id="vertical-form-2" type="text" name="summary" class="form-control h-50"></textarea>
                </div>
                <div class="mt-3 text-right">
                    <a href="{{route('kegiatan.galeri.index')}}" class="btn btn-danger mt-5">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
