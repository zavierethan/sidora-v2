@extends('layouts.auth')

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4 items-center justify-center h-screen">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <div class="my-auto">
                <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                    src="{{asset('assets/images/logo_sidora_new.png')}}">
            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->

        <form method="POST" action="{{route('transaksi.registration.save')}}" class="h-screen xl:h-auto py-5 my-10 xl:my-0">
            @csrf
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-5 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4  xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Register
                </h2>
                @if (Session::has('msg'))
                    <div class="alert alert-primary alert-dismissible show flex items-center mt-5" role="alert"> <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> <a href="/">{{ Session::get('msg') }}</a> <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button> </div>
                @endif
                <div class="intro-x mt-8">
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="form-labe sm:w-32 font-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama-lengkap" required>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="form-labe sm:w-32 font-bold">Email</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="form-labe sm:w-32 font-bold">No Telepon</label>
                        <input type="text" class="form-control" name="no_telepon" id="no-telepon" required>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="form-labe sm:w-32 font-bold">jenis Akun</label>
                        <select data-placeholder="Pilih Jenis Account" class="tom-select w-full form-control" id="jenis-akun" name="jenis_akun" required>
                            <option value=" "> - </option>
                            <option value="2"> KONI </option>
                            <option value="3"> NPCI </option>
                            <option value="4"> KORMI </option>
                            <option value="5"> KECAMATAN </option>
                            <option value="6"> DESA / KELURAHAN</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5" id="kecamatan-form-input">
                        <label for="input-wizard-2" class="form-labe sm:w-32 font-bold">Kecamatan</label>
                        <select data-placeholder="Pilih Kecamatan" class="tom-select w-full form-control" id="kecamatan" name="kecamatan_id">
                            <option value=" "> - </option>
                            @foreach($kecamatans as $kecamatan)
                            <option value="{{$kecamatan->id}}"> {{$kecamatan->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-inline mt-5" id="desa-kelurahan-form-input">
                        <label for="input-wizard-2" class="form-labe sm:w-32 font-bold">Desa / Kelurahan</label>
                        <select data-placeholder="Pilih Desa / Kelurahan" class="tom-select w-full form-control" id="desa-kelurahan" name="desa_kelurahan_id">
                            <option value=" "> - </option>
                            @foreach($desaKelurahan as $desa)
                            <option value="{{$desa->id}}"> {{$desa->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
 		<div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                    <a href="/login" class="ml-auto">Kembali Ke Halaman Login</a>
                </div>

                <div class="intro-x mt-5 xl:mt-8 flex justify-end">
                    <button type="submit" class="btn btn-primary py-3 px-4 w-full sm:w-auto xl:w-32 ml-auto">Daftar</button>
                </div>
            </div>
        </form>
        <!-- END: Login Form -->
    </div>
</div>
@endsection

@section('script')
<script>
$(function () {

    $("#kecamatan-form-input").hide();
    $("#desa-kelurahan-form-input").hide();

    $("#jenis-akun").change(function() {

        if($(this).val() == 2 || $(this).val() == 3 || $(this).val() == 4) {
            $("#kecamatan-form-input").hide();
            $("#desa-kelurahan-form-input").hide();
        } else {
            $("#kecamatan-form-input").show();
            $("#desa-kelurahan-form-input").show();
        }
    });
})
</script>
@endsection
