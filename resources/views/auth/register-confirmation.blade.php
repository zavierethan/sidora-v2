@extends('layouts.auth')

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4 items-center justify-center h-screen">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <div class="my-auto">
                <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                    src="{{asset('assets/images/dispora-logo.png')}}">
            </div>
        </div>
        <!-- END: Login Info -->
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