@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Edit
    </h2>
    <div class="intro-y box col-span-12 lg:col-span-6 mt-5">
        <div id="vertical-form" class="p-5">
            <form class="preview" action="{{route('master.induk-olahraga.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="vertical-form-1" class="sm:w-40 font-bold">Nama</label>
                    <input type="text" name="nama" class="form-control mt-2" value="{{$data->nama}}">
                    <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Kategori</label>
                    <input type="text" name="kategori" value="{{$data->kategori}}" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="vertical-form-2" class="form-label">Organisasi Pembina</label>
                    <select data-placeholder="Pilih Organisasi Pembina" class="tom-select w-full form-control" name="organisasi_pembina" required>
                        <option value=" "> - </option>
                        <option value="KONI" <?php echo ($data->organisasi_pembina == 'KONI') ? 'selected' : ''; ?>>KONI</option>
                        <option value="NPCI" <?php echo ($data->organisasi_pembina == 'NPCI') ? 'selected' : ''; ?>>NPCI</option>
                        <option value="KORMI" <?php echo ($data->organisasi_pembina == 'KORMI') ? 'selected' : ''; ?>>KORMI</option>
                    </select>
                </div>
                <div class="mt-3 text-right">
                    <a href="{{route('master.induk-olahraga.index')}}" class="btn btn-danger mt-5">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-5">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
