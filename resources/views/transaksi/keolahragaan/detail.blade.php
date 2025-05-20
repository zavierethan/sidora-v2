@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <div class="intro-y box py-10 sm:py-10 mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-x flex items-right mt-5 lg:mt-0 flex-1 z-10">
                <div class="flex items-center mr-auto text-lg font-bold">Informasi Wilayah</div>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-6 pt-6 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y grid grid-cols-12 gap-6">
                <!-- Kolom 1 -->
                <div class="col-span-12 sm:col-span-6">
                    <div class="form-inline">
                        <label class="sm:w-40 font-bold">Kecamatan</label>
                        <input type="text" class="form-control" value="{{ $wilayah->nama_kecamatan }}" readonly>
                        <input type="hidden" class="form-control" value="{{ $wilayah->id }}" id="desa-kel-id">
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <div class="form-inline">
                        <label for="vertical-form-1" class="sm:w-40 font-bold">Tahun</label>
                        <?php
                            $current_year = date('Y');
                            $years_range = range($current_year + 5, $current_year - 5);
                        ?>
                        <select data-placeholder="Pilih Tahun" class="tom-select w-full form-control" id="tahun"
                            name="tahun" required>
                            <option value=" ">All</option>
                            @foreach($years_range as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div class="col-span-12 sm:col-span-6">
                    <div class="form-inline">
                        <label class="sm:w-40 font-bold">Desa / Kelurahan</label>
                        <input type="text" class="form-control" value="{{ $wilayah->nama_desa_kelurahan }}" readonly>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <a href="{{route('transaksi.keolahragaan.index')}}" class="btn btn-danger w-24 ml-2">Kembali</a>
                <a href="/transaksi/keolahragaan/export/{{$wilayah->id}}"
                    class="btn btn-success w-24 ml-2 text-white">Export</a>
            </div>
        </div>
    </div>
    <div class="intro-y box mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <h2 class="intro-y text-lg font-medium mt-10">Data sarana (Infrastruktur Keolahragaan)</h2>
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-sarana"
                    class="btn btn-primary intro-y font-medium mt-10 ml-auto">Tambah Data</a>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-6 pt-6 border-t border-slate-200/60 dark:border-darkmode-400">
            <table class="table -mt-2 mb-5" id="data-sarana">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Nama Sarana</th>
                        <th class="whitespace-nowrap">Tipe Sarana</th>
                        <th class="whitespace-nowrap">Status Kepemilikan</th>
                        <th class="whitespace-nowrap">Nama Pemilik</th>
                        <th class="whitespace-nowrap">Ukuran</th>
                        <th class="whitespace-nowrap">Status Kondisi</th>
                        <th class="whitespace-nowrap">Latitude</th>
                        <th class="whitespace-nowrap">Longitude</th>
                        <th class="whitespace-nowrap">Alamat</th>
                        <th class="whitespace-nowrap">Tahun</th>
                        <th class="whitespace-nowrap text-center">Foto Lokasi</th>
                        <th class="whitespace-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="sarana-table-body">

                </tbody>
            </table>
        </div>
    </div>

    <div class="intro-y box mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <h2 class="intro-y text-lg font-medium mt-10">Data Prasarana (Fasilitas Hibah Dari Pemerintah)</h2>
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-prasarana"
                    class="btn btn-primary intro-y font-medium mt-10 ml-auto">Tambah Data</a>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-6 pt-6 border-t border-slate-200/60 dark:border-darkmode-400">
            <table class="table -mt-2" id="data-prasarana">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Nama Prasrana</th>
                        <th class="whitespace-nowrap">Jumlah</th>
                        <th class="whitespace-nowrap">Satuan</th>
                        <th class="whitespace-nowrap">Status Layak</th>
                        <th class="whitespace-nowrap">Hibah Pemerintah</th>
                        <th class="whitespace-nowrap">Tahun</th>
                        <th class="whitespace-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="prasarana-table-body">

                </tbody>
            </table>
        </div>
    </div>

    <div class="intro-y box mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <h2 class="intro-y text-lg font-medium mt-10">Data Kegiatan Olahraga (Kelompok / Klub Olahraga)</h2>
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-kegiatan-olahraga"
                    class="btn btn-primary intro-y font-medium mt-10 ml-auto">Tambah Data</a>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-6 pt-6 border-t border-slate-200/60 dark:border-darkmode-400">
            <table class="table -mt-2" id="data-kegiatan-olahraga">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Cabang olahraga</th>
                        <th class="whitespace-nowrap">Nama Kelompok (Klub)</th>
                        <th class="whitespace-nowrap">Nama Ketua Klub</th>
                        <th class="whitespace-nowrap">Jumlah Anggota</th>
                        <th class="whitespace-nowrap">Terverifikasi</th>
                        <th class="whitespace-nowrap">Nomor SK</th>
                        <th class="whitespace-nowrap">Alamat Sekretariat</th>
                        <th class="whitespace-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="kegitaan-olahraga-table-body">
                </tbody>
            </table>
        </div>
    </div>

    <div id="form-prestasi-olahraga" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Prestasi Olahraga
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.prestasi-olahraga.save')}}" method="POST"
                            class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Klub</label>
                                    <input id="input-wizard-2" type="text" class="form-control">
                                    <input type="hidden" class="form-control" name="des_kel_id" value="{{$wilayah->id}}"
                                        readonly>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Cabang Olahraga</label>
                                    <select id="input-wizard-1" type="text" class="tom-select w-full form-control"
                                        name="cabang_olahraga_id">
                                        <option value=" "> - </option>
                                        @foreach($cabangOlahraga as $sr)
                                        <option value="{{$sr->id}}">{{$sr->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Prestasi Yang di Raih</label>
                                    <input id="input-wizard-2" type="text" class="form-control" name="">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Data Tahun</label>
                                    <?php
                                        // Get the current year
                                        $current_year = date('Y');
                                        // Calculate the range of years
                                        $years_range = range($current_year - 5, $current_year + 5);
                                    ?>
                                    <select data-placeholder="Pilih Tahun" class="tom-select w-full form-control"
                                        id="tahun" name="tahun" required>
                                        @foreach($years_range as $year)
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-prestasi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <div id="form-sarana" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Sarana (Infrastruktur Olahraga)
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.sarana.save')}}" method="POST"
                            enctype="multipart/form-data" class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Sarana</label>
                                    <select type="text" class="tom-select w-full form-control" name="sarana_id"
                                        id="sarana-id">
                                        <option value=" "> - </option>
                                        @foreach($infrastruktur as $sarana)
                                        <option value="{{$sarana->id}}">{{$sarana->nama}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control" name="des_kel_id" value="{{$wilayah->id}}"
                                        readonly>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tipe Sarana</label>
                                    <select type="text" class="tom-select w-full form-control" name="tipe_sarana"
                                        id="tipe-sarana">
                                        <option value=" "> - </option>
                                        <option value="1">Indoor</option>
                                        <option value="2">Outdoor</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Status Kepemilikan</label>
                                    <select type="text" class="tom-select w-full form-control" name="status_kepemilikan"
                                        id="status-kepemilikan">
                                        <option value=" "> - </option>
                                        <option value="1">Milik Pribadi</option>
                                        <option value="2">Pemerintah</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Pemilik</label>
                                    <input type="text" class="form-control" name="nama_pemilik" id="nama-pemilik">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Ukuran</label>
                                    <input type="text" class="form-control" name="ukuran" id="ukuran">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Status Kondisi</label>
                                    <select type="text" class="tom-select w-full form-control" name="status_kondisi"
                                        id="status-kondisi">
                                        <option value=" "> - </option>
                                        <option value="1">Layak Pakai</option>
                                        <option value="2">Tidak Layak Pakai</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Longitude</label>
                                    <input type="text" class="form-control" name="longitude" id="longitude">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat" id="alamat"></textarea>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Foto Lokasi 1</label>
                                    <input id="input-wizard-1" type="file" class="form-control" name="foto_lokasi_1"
                                        id="foto-lokasi-1">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Data Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-prestasi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <div id="form-prasarana" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Prasarana
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.prasarana.save')}}" method="POST"
                            enctype="multipart/form-data" class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Prasarana</label>
                                    <select type="text" class="tom-select w-full form-control" name="prasarana_id"
                                        id="prasarana-id">
                                        <option value=" "> - </option>
                                        @foreach($mPrasarana as $prs)
                                        <option value="{{$prs->id}}">{{$prs->nama}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control" name="des_kel_id" value="{{$wilayah->id}}"
                                        readonly>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Hibah Pemerintah</label>
                                    <select type="text" class="tom-select w-full form-control" name="hibah_pemerintah"
                                        id="hibah-pemerintah">
                                        <option value=" "> - </option>
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" id="jumlah">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Status Layak</label>
                                    <select type="text" class="tom-select w-full form-control" name="status_layak"
                                        id="status-layak">
                                        <option value=" "> - </option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak </option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
                                <!-- <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Lampiran (Foto)</label>
                                    <input type="file" class="form-control" name="lampiran" id="lampiran">
                                </div> -->
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-prestasi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <div id="form-kegiatan-olahraga" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Kegiatan Olahraga
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.kegiatan-olahraga.save')}}" method="POST"
                            class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Cabang Olahraga</label>
                                    <select type="text" class="tom-select w-full form-control" name="cabang_olahraga_id"
                                        id="cabang-olahraga-id">
                                        <option value=" "> - </option>
                                        @foreach($cabangOlahraga as $co)
                                        <option value="{{$co->id}}">{{$co->nama}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control" name="des_kel_id" value="{{$wilayah->id}}"
                                        readonly>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Kelompok (Klub)</label>
                                    <input type="text" class="form-control" name="nama_kelompok" id="nama-kelompok">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Ketua Klub</label>
                                    <input type="text" class="form-control" name="nama_ketua_kelompok"
                                        id="nama-ketua-kelompok">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Jumlah Anggota</label>
                                    <input type="text" class="form-control" name="jumlah_anggota" id="jumlah-anggota">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Terverifikasi ?</label>
                                    <select type="text" class="tom-select w-full form-control" name="terverifikasi"
                                        id="terverifikasi">
                                        <option value=" "> - </option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nomor SK</label>
                                    <input type="text" class="form-control" name="nomor_sk" id="nomor-sk">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat Sekertariat</label>
                                    <textarea type="text" class="form-control" name="alamat_sekretariat"
                                        id="alamat-sekretariat"></textarea>
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-prestasi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <div id="view-image" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box ">
                        <img id="img-holder" src="" />
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit -->

    <div id="form-edit-sarana" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Edit Sarana (Infrastruktur Olahraga)
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.sarana.update')}}" method="POST"
                            enctype="multipart/form-data" class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Sarana</label>
                                    <select type="text" class="tom-select w-full form-control sarana_id"
                                        name="sarana_id">
                                        <option value=" "> - </option>
                                        @foreach($infrastruktur as $sarana)
                                        <option value="{{$sarana->id}}">{{$sarana->nama}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control id" name="id">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tipe Sarana</label>
                                    <select type="text" class="tom-select w-full form-control tipe_sarana"
                                        name="tipe_sarana">
                                        <option value=" "> - </option>
                                        <option value="1">Indoor</option>
                                        <option value="2">Outdoor</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Status Kepemilikan</label>
                                    <select type="text" class="tom-select w-full form-control status_kepemilikan"
                                        name="status_kepemilikan">
                                        <option value=" "> - </option>
                                        <option value="1">Milik Pribadi</option>
                                        <option value="2">Pemerintah</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Pemilik</label>
                                    <input type="text" class="form-control nama_pemilik" name="nama_pemilik">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Ukuran</label>
                                    <input type="text" class="form-control ukuran" name="ukuran">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Status Kondisi</label>
                                    <select type="text" class="tom-select w-full form-control status_kondisi"
                                        name="status_kondisi">
                                        <option value=" "> - </option>
                                        <option value="1">Layak Pakai</option>
                                        <option value="2">Tidak Layak Pakai</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Latitude</label>
                                    <input type="text" class="form-control latitude" name="latitude">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Longitude</label>
                                    <input type="text" class="form-control longitude" name="longitude">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat</label>
                                    <textarea type="text" class="form-control alamat" name="alamat"></textarea>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Foto Lokasi 1</label>
                                    <input id="input-wizard-1" type="file" class="form-control" name="foto_lokasi_1">
                                    <input id="input-wizard-1" type="hidden" class="form-control ex_foto_lokasi_1"
                                        name="ex_foto_lokasi_1">
                                </div>
                                <div class="form-inline mt-3">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold"></label>
                                    <small class="text-danger">Pilih untuk memperbaharui lampiran foto lokasi</small>
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <div id="form-edit-prasarana" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Edit Prasarana
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.prasarana.update')}}" method="POST"
                            enctype="multipart/form-data" class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Prasarana</label>
                                    <select type="text" class="tom-select w-full form-control prasarana_id"
                                        name="prasarana_id">
                                        <option value=" "> - </option>
                                        @foreach($mPrasarana as $prs)
                                        <option value="{{$prs->id}}">{{$prs->nama}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control id" name="id">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Hibah Pemerintah</label>
                                    <select type="text" class="tom-select w-full form-control hibah_pemerintah"
                                        name="hibah_pemerintah">
                                        <option value=" "> - </option>
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Jumlah</label>
                                    <input type="text" class="form-control jumlah" name="jumlah">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Status Layak</label>
                                    <select type="text" class="tom-select w-full form-control status_layak"
                                        name="status_layak">
                                        <option value=" "> - </option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak </option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tahun</label>
                                    <input type="text" class="form-control tahun" name="tahun">
                                </div>
                                <!-- <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Lampiran (Foto)</label>
                                    <input type="file" class="form-control" name="lampiran" id="lampiran">
                                </div> -->
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <div id="form-edit-kegiatan-olahraga" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Edit Kegiatan Olahraga
                            </h2>
                        </div>
                        <form action="{{route('transaksi.keolahragaan.kegiatan-olahraga.update')}}" method="POST"
                            class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Cabang Olahraga</label>
                                    <select type="text" class="tom-select w-full form-control cabang_olahraga_id"
                                        name="cabang_olahraga_id">
                                        <option value=" "> - </option>
                                        @foreach($cabangOlahraga as $co)
                                        <option value="{{$co->id}}">{{$co->nama}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control id" name="id">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Kelompok (Klub)</label>
                                    <input type="text" class="form-control nama_kelompok" name="nama_kelompok">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Ketua Klub</label>
                                    <input type="text" class="form-control nama_ketua_kelompok"
                                        name="nama_ketua_kelompok">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Jumlah Anggota</label>
                                    <input type="text" class="form-control jumlah_anggota" name="jumlah_anggota">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-1" class="sm:w-40 font-bold">Terverifikasi ?</label>
                                    <select type="text" class="tom-select w-full form-control terverifikasi"
                                        name="terverifikasi">
                                        <option value=" "> - </option>
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nomor SK</label>
                                    <input type="text" class="form-control nomor_sk" name="nomor_sk">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat Sekertariat</label>
                                    <textarea type="text" class="form-control alamat_sekretariat"
                                        name="alamat_sekretariat"></textarea>
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Edit -->
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
$(function() {

    var desaKelId = $("#desa-kel-id").val();

    getSarana(desaKelId, '');
    getPrasarana(desaKelId, '');
    getKegiatanOlahraga(desaKelId, '');

    $("#tahun").change(function() {
        let tahun = $(this).val();

        getSarana(desaKelId, tahun);
        getPrasarana(desaKelId, tahun);
        // getKegiatanOlahraga(desaKelId, tahun);
    });

    $(".view-img").click(function() {
        var row = $(this).closest('tr');
        var row_id = row.attr('data-id');
        getImgRowById(row_id);
    });

    $(".edit-sarana").click(function() {
        var row = $(this).closest('tr');
        var row_id = row.attr('data-id');

        console.log("Row ID => " + row_id)
        getSaranaRowById(row_id);
    });

    $(".edit-prasarana").click(function() {
        var row = $(this).closest('tr');
        var row_id = row.attr('data-id');
        getPrasaranaRowById(row_id);
    });

    $(".edit-kegiatan").click(function() {
        var row = $(this).closest('tr');
        var row_id = row.attr('data-id');
        getKegiatanRowById(row_id);
    });

    function getSarana(id, tahun) {

        if ($.fn.DataTable.isDataTable('#data-sarana')) {
            $('#data-sarana').DataTable().destroy();
        }

        $("#data-sarana").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            ajax: {
                url: `/transaksi/keolahragaan/sarana/get-lists`, // Replace with your route
                type: 'GET',
                data: function(d) {
                    d.desa_kelurahan = id;
                    d.tahun = tahun;
                },
                dataSrc: function(json) {
                    return json.data; // Map the 'data' field
                }
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'str_tipe_sarana',
                    name: 'str_tipe_sarana'
                },
                {
                    data: 'str_status_kepemilikan',
                    name: 'str_status_kepemilikan',
                },
                {
                    data: 'nama_pemilik',
                    name: 'nama_pemilik',
                },
                {
                    data: 'ukuran',
                    name: 'ukuran',
                },
                {
                    data: 'str_status_kondisi',
                    name: 'str_status_kondisi',
                },
                {
                    data: 'lat',
                    name: 'lat',
                },
                {
                    data: 'long',
                    name: 'long',
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                },
                {
                    data: 'ukuran',
                    name: 'ukuran',
                },
                {
                    data: 'tahun',
                    name: 'tahun',
                },
                {
                    data: null, // No direct field from the server
                    name: 'action',
                    orderable: false, // Disable ordering for this column
                    searchable: false, // Disable searching for this column
                    render: function(data, type, row) {
                        return `
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5 edit-sarana"
                                        href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-edit-sarana">
                                        <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a href="/transaksi/keolahragaan/sarana/delete/${row.id}"
                                    class="flex items-center text-danger whitespace-nowrap mr-5"
                                    onclick="return confirm('Apakah anda yakin ?')">
                                    <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        `;
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                // Add data-id attribute from your data source (assuming `id` field exists)
                $(row).attr('data-id', data.id);
            }
        });
    }

    function getPrasarana(id, tahun) {

        if ($.fn.DataTable.isDataTable('#data-prasarana')) {
            $('#data-prasarana').DataTable().destroy();
        }

        $("#data-prasarana").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            ajax: {
                url: `/transaksi/keolahragaan/prasarana/get-lists`, // Replace with your route
                type: 'GET',
                data: function(d) {
                    d.desa_kelurahan = id;
                    d.tahun = tahun;
                },
                dataSrc: function(json) {
                    return json.data; // Map the 'data' field
                }
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'satuan',
                    name: 'satuan',
                },
                {
                    data: 'str_status_layak',
                    name: 'str_status_layak',
                },
                {
                    data: 'hibah_pemerintah',
                    name: 'hibah_pemerintah',
                },
                {
                    data: 'tahun',
                    name: 'tahun',
                },
                {
                    data: null, // No direct field from the server
                    name: 'action',
                    orderable: false, // Disable ordering for this column
                    searchable: false, // Disable searching for this column
                    render: function(data, type, row) {
                        return `
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/transaksi/keolahragaan/detail/${row.id}"> <i
                                        data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a href="/transaksi/keolahragaan/prasarana/delete/${row.id}"
                                    class="flex items-center text-danger whitespace-nowrap mr-5"
                                    onclick="return confirm('Apakah anda yakin ?')">
                                    <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        `;
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                // Add data-id attribute from your data source (assuming `id` field exists)
                $(row).attr('data-id', data.id);
            }
        });
    }

    function getKegiatanOlahraga(id, tahun) {
        $("#data-kegiatan-olahraga").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            ajax: {
                url: `/transaksi/keolahragaan/kegiatan-olahraga/get-lists`, // Replace with your route
                type: 'GET',
                data: function(d) {
                    d.desa_kelurahan = id;
                    d.tahun = tahun;
                },
                dataSrc: function(json) {
                    return json.data; // Map the 'data' field
                }
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_kelompok',
                    name: 'nama_kelompok'
                },
                {
                    data: 'nama_ketua_kelompok',
                    name: 'nama_ketua_kelompok'
                },
                {
                    data: 'jumlah_anggota',
                    name: 'jumlah_anggota',
                },
                {
                    data: 'str_terverifikasi',
                    name: 'str_terverifikasi',
                },
                {
                    data: 'nomor_sk',
                    name: 'nomor_sk',
                },
                {
                    data: 'alamat_sekretariat',
                    name: 'alamat_sekretariat',
                },
                {
                    data: null, // No direct field from the server
                    name: 'action',
                    orderable: false, // Disable ordering for this column
                    searchable: false, // Disable searching for this column
                    render: function(data, type, row) {
                        return `
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/transaksi/keolahragaan/detail/${row.id}"> <i
                                        data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a href="/transaksi/keolahragaan/kegiatan-olahraga/delete/${row.id}"
                                    class="flex items-center text-danger whitespace-nowrap mr-5"
                                    onclick="return confirm('Apakah anda yakin ?')">
                                    <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        `;
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                $(row).attr('data-id', data.id);
            }
        });
    }

    function getImgRowById(id) {

        console.log(id)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("transaksi.get.image.by.sarana.id")}}', // Specify the URL of your server endpoint
            type: 'POST', // or 'POST' depending on your server setup
            dataType: 'json', // Assuming the response will be
            data: {
                id: id
            },
            success: function(response) {

                // Assuming response.data is an array of SPK objects
                var data = response.data;

                $("#img-holder").attr("src", "data:image/jpeg;base64," + data.foto_lokasi_1);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function getSaranaRowById(id) {

        console.log(id)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("transaksi.get.sarana.id")}}',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                var data = response.data;

                console.log(data)

                $("#form-edit-sarana .id").val(data.id);

                const sarana_id = $("#form-edit-sarana .sarana_id")[0].tomselect;
                sarana_id.setValue(data.sarana_id);

                const tipe_sarana = $("#form-edit-sarana .tipe_sarana")[0].tomselect;
                tipe_sarana.setValue(data.tipe_sarana);

                const status_kepemilikan = $("#form-edit-sarana .status_kepemilikan")[0].tomselect;
                status_kepemilikan.setValue(data.status_kepemilikan);

                $("#form-edit-sarana .nama_pemilik").val(data.nama_pemilik);
                $("#form-edit-sarana .ukuran").val(data.ukuran);

                const status_kondisi = $("#form-edit-sarana .status_kondisi")[0].tomselect;
                status_kondisi.setValue(data.status_kondisi)

                $("#form-edit-sarana .latitude").val(data.lat);
                $("#form-edit-sarana .longitude").val(data.long);
                $("#form-edit-sarana .alamat").val(data.alamat);
                $("#form-edit-sarana .ex_foto_lokasi_1").val(data.foto_lokasi_1);


            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function getPrasaranaRowById(id) {

        console.log(id)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("transaksi.get.prasarana.id")}}',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                var data = response.data;

                console.log(data)

                $("#form-edit-prasarana .id").val(data.id);

                const prasarana_id = $("#form-edit-prasarana .prasarana_id")[0].tomselect;
                prasarana_id.setValue(data.prasarana_id);

                const hibah_pemerintah = $("#form-edit-prasarana .hibah_pemerintah")[0].tomselect;
                hibah_pemerintah.setValue(data.hibah_pemerintah);

                const status_layak = $("#form-edit-prasarana .status_layak")[0].tomselect;
                status_layak.setValue(data.status_layak);

                $("#form-edit-prasarana .prasarana_id").val(data.prasarana_id);
                $("#form-edit-prasarana .hibah_pemeritah").val(data.hibah_pemeritah);
                $("#form-edit-prasarana .jumlah").val(data.jumlah);
                $("#form-edit-prasarana .status_layak").val(data.status_layak);
                $("#form-edit-prasarana .tahun").val(data.tahun);


            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function getKegiatanRowById(id) {

        console.log(id)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("transaksi.get.kegiatan.olahraga.by.id")}}',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                var data = response.data;

                console.log(data)

                $("#form-edit-kegiatan-olahraga .id").val(data.id);

                const cabang_olahraga_id = $("#form-edit-kegiatan-olahraga .cabang_olahraga_id")[0]
                    .tomselect;
                cabang_olahraga_id.setValue(data.cabang_olahraga_id);

                $("#form-edit-kegiatan-olahraga .nama_kelompok").val(data.nama_kelompok);
                $("#form-edit-kegiatan-olahraga .nama_ketua_kelompok").val(data
                    .nama_ketua_kelompok);
                $("#form-edit-kegiatan-olahraga .jumlah_anggota").val(data.jumlah_anggota);

                const terverifikasi = $("#form-edit-kegiatan-olahraga .terverifikasi")[0].tomselect;
                terverifikasi.setValue(data.terverifikasi);

                $("#form-edit-kegiatan-olahraga .nomor_sk").val(data.nomor_sk);
                $("#form-edit-kegiatan-olahraga .alamat_sekretariat").val(data.alamat_sekretariat);


            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
});
</script>
@endsection
