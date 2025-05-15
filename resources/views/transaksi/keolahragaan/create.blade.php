@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</button>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Data Sarana
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</button>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Data Prasarana
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</button>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Kegiatan
                    Olahraga di Masyarakat</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">4</button>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prestasi Atlet
                </div>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-2 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="form-inline"> 
                        <label for="input-wizard-1" class="form-label sm:w-40">Nama Sarana</label>
                        <select id="input-wizard-1" type="text" class="form-control"> 
                            <option value=" "> - </option>
                            @foreach($sarana as $sr)
                            <option value="{{$sr->id}}">{{$sr->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Tipe Sarana</label>
                        <select id="input-wizard-1" type="text" class="form-control"> 
                            <option value=" "> - </option>
                            <option value="1">Indoor</option>
                            <option value="2">Outdoor</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-1" class="form-label sm:w-40">Status Kepemilikan</label>
                        <select id="input-wizard-1" type="text" class="form-control"> 
                            <option value=" "> - </option>
                            <option value="1">Pribadi</option>
                            <option value="2">Club</option>
                            <option value="3">Pemerintah</option>
                            <option value="4">Hak Guna Pakai</option>
                        </select> 
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Nama Pemilik</label>
                        <input id="input-wizard-2" type="text" class="form-control">
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-1" class="form-label sm:w-40">Ukuran</label>
                        <input id="input-wizard-1" type="text" class="form-control"> 
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Status Kondisi</label>
                        <select id="input-wizard-1" type="text" class="form-control"> 
                            <option value=" "> - </option>
                            <option value="1">Buruk</option>
                            <option value="2">Cukup</option>
                            <option value="3">Baik</option>
                        </select>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="form-inline"> 
                        <label for="input-wizard-1" class="form-label sm:w-40">Foto Lokasi 1</label>
                        <input id="input-wizard-1" type="file" class="form-control"> 
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Foto Lokasi 2</label>
                        <input id="input-wizard-2" type="file" class="form-control">
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-1" class="form-label sm:w-40">Foto Lokasi 3</label>
                        <input id="input-wizard-1" type="file" class="form-control"> 
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Foto Lokasi 4</label>
                        <input id="input-wizard-2" type="file" class="form-control">
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-1" class="form-label sm:w-40">Latitude</label>
                        <input id="input-wizard-1" type="text" class="form-control"> 
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Longitude</label>
                        <input id="input-wizard-2" type="text" class="form-control">
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="form-label sm:w-40">Alamat</label>
                        <input id="input-wizard-2" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Nama Sarana</th>
                            <th class="whitespace-nowrap">Tipe Sarana</th>
                            <th class="whitespace-nowrap">Ststus Kepemilikan</th>
                            <th class="whitespace-nowrap">Nama Pemilik</th>
                            <th class="whitespace-nowrap">Ukuran</th>
                            <th class="whitespace-nowrap">Status Kondisi</th>
                            <th class="whitespace-nowrap">Latitude</th>
                            <th class="whitespace-nowrap">Longitude</th>
                            <th class="whitespace-nowrap">Alamat</th>
                            <th class="text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
</div>
@endsection