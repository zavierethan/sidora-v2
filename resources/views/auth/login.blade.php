@extends('layouts.auth')

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <div class="my-auto">
                <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                    src="{{asset('assets/images/logo_sidora_new.png')}}">
            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->

        <form method="POST" action="{{route('login')}}" class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            @csrf
            <div
                class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Login
                </h2>
                <div class="intro-x mt-8">
                    <input id="name" type="text"
                        class="intro-x login__input form-control py-3 px-4 block @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name"
                        placeholder="Username" autofocus>
                    @error('name')
                    <span class="invalid-feedback text-danger mt-6" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="password" type="password"
                        class="intro-x login__input form-control py-3 px-4 block mt-4 @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                    <a href="/register">Belum Punya Akun ? Klik untuk daftar</a>
                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                </div>
            </div>
        </form>
        <!-- END: Login Form -->
    </div>
</div>
@endsection
