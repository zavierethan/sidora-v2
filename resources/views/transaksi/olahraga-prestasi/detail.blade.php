@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-10 mt-5">

        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-x flex items-left mt-5 lg:mt-0 lg:block flex-1 z-10">
                <!-- <button id="confirm-and-save" class="flex items-center ml-auto text-white btn btn-primary shadow-md">konfirmasi & Simpan</button> -->
            </div>
        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-2 gap-y-5">
                <div class="intro-y col-span-12 sm:col-span-6 p-3">
                    <div class="form-inline">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{$prestasiKeolahragaan->nama}}">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat-lahir" value="{{$prestasiKeolahragaan->tempat_lahir}}">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal-lahir" value="{{$prestasiKeolahragaan->tanggal_lahir}}">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Desa / Kelurahan</label>
                        <select data-placeholder="Pilih Desa / Kelurahan" class="tom-select w-full form-control" id="desa-kelurahan" name="desa_kelurahan" required>
                            @foreach($desaKelurahan as $deskel)
                            <option value="{{$deskel->id}}" <?php echo ($deskel->id == $prestasiKeolahragaan->desa_kelurahan_id) ? 'selected' : '';?>>KEC.{{$deskel->kecamatan}} - {{$deskel->desa_kelurahan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat Lengkap</label>
                        <textarea type="text" class="form-control" name="alamat_lengkap" id="alamat-lengkap">{{$prestasiKeolahragaan->alamat_lengkap}}</textarea>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 p-3">
                    <div class="form-inline">
                        <label for="horizontal-form-2" class="sm:w-40 font-bold">Organisasi Pembina</label>
                        <select data-placeholder="Pilih Kategori Prestasi" class="tom-select w-full form-control" id="kategori" name="kategori" required>
                            <option value="KONI" <?php echo ($prestasiKeolahragaan->organisasi_pembina == 'KONI') ? 'selected' : '';?>>KONI</option>
                            <option value="NPCI" <?php echo ($prestasiKeolahragaan->organisasi_pembina == 'NPCI') ? 'selected' : '';?>>NPCI</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="sm:w-40 font-bold">Kategori</label>
                        <select data-placeholder="Pilih Kategori Prestasi" class="tom-select w-full form-control" id="kategori" name="kategori" required>
                            <option value="1" <?php echo ($prestasiKeolahragaan->kategori == '1') ? 'selected' : '';?>>Atlet</option>
                            <option value="2" <?php echo ($prestasiKeolahragaan->kategori == '2') ? 'selected' : '';?>>Pelatih</option>
                            <option value="3" <?php echo ($prestasiKeolahragaan->kategori == '3') ? 'selected' : '';?>>Wasit - Juri</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="sm:w-40 font-bold">Cabang Olahraga</label>
                        <select data-placeholder="Pilih Cabang Olahraga" class="tom-select w-full form-control" id="cabang-olahraga" name="cabang_olahraga" required>
                            @foreach($cabangOlahraga as $cabor)
                            <option value="{{$cabor->id}}" <?php echo ($cabor->id == $prestasiKeolahragaan->cabang_olahraga_id) ? 'selected' : '';?>>{{$cabor->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Foto</label>
                        <img id="img-holder" src="{{$prestasiKeolahragaan->foto}}" style="width:150px; height:150px;"/>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold"></label>
                        <input type="file" class="form-control" name="foto" id="foto-upload">
                    </div>
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <a href="{{route('transaksi.olahraga-prestasi.index')}}" class="btn btn-danger w-24 ml-2">Kembali</a>
                    <button class="btn btn-primary w-24 ml-2" id="simpan">Perbaharui</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
    @if($prestasiKeolahragaan->kategori == 2 || $prestasiKeolahragaan->kategori == 3)
    <div id="form-table-lisensi" class="intro-y box py-10 sm:py-10 mt-5">
        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-x flex items-right mt-5 lg:mt-0 flex-1 z-10">
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-lisensi" class="flex items-center ml-auto text-white btn btn-primary shadow-md">Tambah Data Lesensi</a>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Nama Lisensi</th>
                            <th class="whitespace-nowrap">Kategori</th>
                            <th class="whitespace-nowrap">Tahun</th>
                            <th class="whitespace-nowrap text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="lisensi-table-body">
                        @foreach($lisensi as $item)
                        <tr>
                            <td>{{$item->lisensi}}</td>
                            <td>{{$item->kategori}}</td>
                            <td>{{$item->tahun}}</td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-primary whitespace-nowrap mr-5" href="{{route('transaksi.olahraga-prestasi.detail', ['id' => $item->id])}}"> <i
                                            data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger whitespace-nowrap mr-5" href="{{route('transaksi.olahraga-prestasi.delete', ['keolahragaanId' => $prestasiKeolahragaan->id, 'id' => $item->id])}}" onclick="return confirm('Apakah anda yakin ?')"> <i
                                            data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @if($prestasiKeolahragaan->kategori == 1 )
    <div id="form-table-prestasi" class="intro-y box py-10 sm:py-10 mt-5">
        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-x flex items-left mt-5 lg:mt-0 flex-1 z-10">
                <!-- <h2 class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400 text-xl">Daftar Prestasi </h2> -->
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-prestasi" class="flex items-center ml-auto text-white btn btn-primary shadow-md">Tambah Data Prestasi</a>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Nama Prestasi</th>
                            <th class="whitespace-nowrap">Kategori</th>
                            <th class="whitespace-nowrap">Peraihan Medali</th>
                            <th class="whitespace-nowrap">Tahun</th>
                            <th class="whitespace-nowrap text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="prestasi-table-body">
                        @foreach($prestasi as $item)
                        <tr>
                            <td>{{$item->nama_prestasi}}</td>
                            <td>{{$item->kategori}}</td>
                            <td>{{$item->peraihan_medali}}</td>
                            <td>{{$item->tahun}}</td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-primary whitespace-nowrap mr-5" href="{{route('transaksi.olahraga-prestasi.detail', ['id' => $item->id])}}"> <i
                                            data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger whitespace-nowrap mr-5" href="{{route('transaksi.olahraga-prestasi.delete', ['keolahragaanId' => $prestasiKeolahragaan->id, 'id' => $item->id])}}" onclick="return confirm('Apakah anda yakin ?')"> <i
                                            data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="form-lisensi" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Lisensi
                            </h2>
                        </div>
                        <form action="{{route('transaksi.olahraga-prestasi.detail.save')}}" method="POST" id="horizontal-form" class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Lisensi</label>
                                    <input type="text" class="form-control" name="lisensi" id="lisensi">
                                    <input type="hidden" class="form-control" name="keolahragaan_id" id="keolahragaan-id" value="{{$prestasiKeolahragaan->id}}">
                                    <input type="hidden" class="form-control" name="keolahragaan_kategori" id="keolahragaan-kategori" value="{{$prestasiKeolahragaan->kategori}}">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Kategori</label>
                                    <select data-placeholder="Pilih Kategori" class="tom-select w-full form-control" id="kategori" name="kategori" required>
                                        <option value=" "> - </option>
                                        <option value="1">Daerah</option>
                                        <option value="2">Nasional</option>
                                        <option value="3">Internasional</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-lisensi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="form-prestasi" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Prestasi
                            </h2>
                        </div>
                        <form action="{{route('transaksi.olahraga-prestasi.detail.save')}}" method="POST" id="horizontal-form" class="p-5">
                            @csrf
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Prestasi</label>
                                    <input type="text" class="form-control" name="prestasi" id="prestasi">
                                    <input type="hidden" class="form-control" name="keolahragaan_id" id="keolahragaan-id" value="{{$prestasiKeolahragaan->id}}">
                                    <input type="hidden" class="form-control" name="keolahragaan_kategori" id="keolahragaan-kategori" value="{{$prestasiKeolahragaan->kategori}}">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Kategori</label>
                                    <select data-placeholder="Pilih Kategori" class="tom-select w-full form-control" id="kategori" name="kategori" required>
                                        <option value=" "> - </option>
                                        <option value="1">Daerah</option>
                                        <option value="2">Nasional</option>
                                        <option value="3">Internasional</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Peraihan Medali</label>
                                    <select data-placeholder="Pilih Kategori" class="tom-select w-full form-control" id="peraihan-medali" name="peraihan_medali" required>
                                        <option value=" "> - </option>
                                        <option value="1">Emas</option>
                                        <option value="2">Perak</option>
                                        <option value="3">Perunggu</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-prestasi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- END: Horizontal Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#foto-upload').on('change', function() {
        var id = {{$prestasiKeolahragaan->id}};
        var file = this.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageData = e.target.result; // This is the base64 image data
                console.log(imageData);
                $("#img-holder").attr("src", imageData);
                // Send the base64 image data to the Laravel controller via Ajax
                $.ajax({
                    type: 'POST',
                    url: '{{route("transaksi.olahraga-prestasi.upload-foto")}}', // Use the named route for upload
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pass CSRF token in the request headers
                    },
                    data: { id: id, image: imageData },
                    success: function(response) {
                        console.log('Image uploaded and saved successfully');
                        // Optionally, do something with the response from the server
                    },
                    error: function(xhr, status, error) {
                        console.error('Error uploading image:', error);
                    }
                });
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection
