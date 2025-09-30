@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Edit User
    </h2>
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            icon-name="alert-octagon" data-lucide="alert-octagon" class="lucide lucide-alert-octagon w-6 h-6 mr-2">
            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg> {{ session('error') }}
        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x"
                data-lucide="x" class="lucide lucide-x w-4 h-4">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg> </button>
    </div>
    @endif
    <div class="intro-y box col-span-12 lg:col-span-6 mt-5">
        <div id="vertical-form" class="p-5">
            <form class="preview" action="{{route('transaksi.pengaturan.user.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="vertical-form-1" class="sm:w-40 font-bold">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control mt-2" value="{{$data->nama_lengkap}}">
                    <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="sm:w-40 font-bold">Email</label>
                    <input type="text" name="email" class="form-control mt-2" value="{{$data->email}}">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="sm:w-40 font-bold">Telepon</label>
                    <input type="text" name="no_telepon" class="form-control mt-2" value="{{$data->no_telepon}}">
                </div>
                <div class="mt-3">
                    <label for="input-wizard-2" class="sm:w-40 font-bold">Role</label>
                    <select data-placeholder="Pilih Status" class="tom-select w-full form-control mt-2" name="role_id"
                        required>
                        <option value=" "> - </option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" <?php  echo ($role->id == $data->role_id) ? 'selected' : ''; ?>>
                            {{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="input-wizard-2" class="sm:w-40 font-bold">Status</label>
                    <select data-placeholder="Pilih Status" class="tom-select w-full form-control mt-2" name="status"
                        required>
                        <option value=" "> - </option>
                        <option value="0" <?php  echo ($data->status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                        <option value="1" <?php  echo ($data->status == 1) ? 'selected' : ''; ?>>Aktif</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label class="sm:w-40 font-bold">Reset Password</label>
                    <div class="flex items-center mt-2">
                        <input type="checkbox" name="reset_password" value="1" class="form-check-input">
                        <span class="ml-2">Reset password dengan username</span>
                    </div>
                </div>
                <div class="mt-3 text-right">
                    <a href="{{route('transaksi.pengaturan.user.index')}}" class="btn btn-danger mt-5">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
