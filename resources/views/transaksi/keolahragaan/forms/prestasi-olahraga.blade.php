@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.sarana')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Sarana </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.prasarana')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prasarana
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.kegiatan-olahraga')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Kegiatan
                    Olahraga di Masyarakat</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.prestasi-olahraga')}}"
                    class="w-10 h-10 rounded-full btn btn-primary text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">4</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prestasi Olahraga Masyarakat
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.verifikasi-konfirmasi')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">5</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Verifikasi dan Konfirmasi Data</div>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-2 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Klub</label>
                        <input id="input-wizard-2" type="text" class="form-control" >
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Cabang Olahraga</label>
                        <select id="input-wizard-1" type="text" class="form-control">
                            <option value=" "> - </option>
                            @foreach($cabangOlahraga as $sr)
                            <option value="{{$sr->id}}">{{$sr->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Prestasi Yang di Raih</label>
                        <input id="input-wizard-2" type="text" class="form-control">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Tahun</label>
                        <input id="input-wizard-2" type="text" class="form-control">
                    </div>
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button class="btn btn-primary w-24 ml-2">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Nama Klub</th>
                            <th class="whitespace-nowrap">Cabang Olahraga</th>
                            <th class="whitespace-nowrap">Prestasi Yang di Raih</th>
                            <th class="whitespace-nowrap">Tahun</th>
                            <th class="text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection