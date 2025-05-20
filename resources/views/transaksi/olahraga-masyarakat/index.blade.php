@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Olahraga Masyarakat
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <div class="flex w-full sm:w-auto">
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <select class="form-select w-xl mr-2" id="f-kecamatan">
                        <option value=" ">Kecamatan</option>
                        @foreach($kecamatan as $kec)
                        <option value="{{$kec->id}}">{{$kec->nama}}</option>
                        @endforeach
                    </select>
                    <!-- Dropdown Filter -->
                    <select class="form-select w-xl mr-2" id="f-desa-kelurahan">
                        <option value=" ">Desa / Kelurahan</option>
                        @foreach($desaKelurahan as $deskel)
                        <option value="{{$deskel->id}}">{{$deskel->desa_kelurahan}}</option>
                        @endforeach
                    </select>
                    <input type="text" data-table-filter="search"
                        class="form-control form-control-solid w-xl mr-2 ps-15" placeholder="Cari" />
                </div>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-input"
                    class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>Tambah Data
                </a>
                <a href="{{route('transaksi.olahraga-masyarakat.export')}}"
                    class="btn btn-primary shadow-md mr-2">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>Export
                </a>
            </div>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table -mt-2" id="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Nama</th>
                        <th class="whitespace-nowrap">Tempat Lahir</th>
                        <th class="whitespace-nowrap">Tanggal Lahir</th>
                        <th class="whitespace-nowrap">Jenis Kelamin</th>
                        <th class="whitespace-nowrap">Kecamatan</th>
                        <th class="whitespace-nowrap">Desa / Kelurahan</th>
                        <th class="whitespace-nowrap">Kategori</th>
                        <th class="whitespace-nowrap">Organisasi Pembina</th>
                        <th class="whitespace-nowrap">Induk Olahraga</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
        </div>
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="form-input" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div
                            class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Input Data Olahraga Masyarakat
                            </h2>
                        </div>
                        <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat-lahir">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal-lahir">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Jenis Kelamin</label>
                                    <select data-placeholder="Pilih Jenis Kelamin"
                                        class="tom-select w-full form-control" id="jenis-kelamin" name="jenis_kelamin"
                                        required>
                                        <option value=" "> - </option>
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Desa / Kelurahan</label>
                                    <select data-placeholder="Pilih Desa / Kelurahan"
                                        class="tom-select w-full form-control" id="desa-kelurahan" name="desa_kelurahan"
                                        required>
                                        <option value=" "> - </option>
                                        @foreach($desaKelurahan as $deskel)
                                        <option value="{{$deskel->id}}">KEC.{{$deskel->kecamatan}} -
                                            {{$deskel->desa_kelurahan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat Lengkap</label>
                                    <textarea type="text" class="form-control" name="alamat_lengkap"
                                        id="alamat-lengkap"></textarea>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="horizontal-form-2" class="sm:w-40 font-bold">Kategori</label>
                                    <select data-placeholder="Pilih Kategori Prestasi"
                                        class="tom-select w-full form-control" id="kategori" name="kategori" required>
                                        <option value=" "> - </option>
                                        <option value="1">Atlet</option>
                                        <option value="2">Pelatih</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="horizontal-form-2" class="sm:w-40 font-bold">Organisasi Pembina</label>
                                    <select data-placeholder="Pilih Induk Olahraga"
                                        class="tom-select w-full form-control" id="organisasi-pembina"
                                        name="organisasi_pembina" required disabled>
                                        <option value=" "> - </option>
                                        <option value="KONI">KONI</option>
                                        <option value="NPCI">NPCI</option>
                                        <option value="KORMI" selected>KORMI</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="horizontal-form-2" class="sm:w-40 font-bold">Induk Olahraga</label>
                                    <select data-placeholder="Pilih Cabang Olahraga"
                                        class="tom-select w-full form-control" id="induk-olahraga" name="induk_olahraga"
                                        required>
                                        <option value=" "> - </option>
                                        @foreach($indukOlahraga as $inorga)
                                        <option value="{{$inorga->id}}">{{$inorga->kategori}} - {{$inorga->nama}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Foto</label>
                                    <img id="img-holder" src="" style="width:150px; height:150px;" />
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold"></label>
                                    <input type="file" class="form-control" name="foto" id="foto-upload">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </div>
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
$(function() {

    $('#f-kecamatan').change(function () {
        const kecamatanId = $(this).val();

        // 🧹 Clear Desa/Kelurahan select box lebih dulu
        $('#f-desa-kelurahan').html('<option value="">Desa / Kelurahan</option>');

        if (kecamatanId) {
            $.ajax({
                url: `/master/desa-kelurahan/by-kecamatan/${kecamatanId}`,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        let options = `<option value="">Desa / Kelurahan</option>`;
                        response.data.forEach(function (item) {
                            options += `<option value="${item.id}">${item.nama}</option>`;
                        });
                        $('#f-desa-kelurahan').html(options);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Gagal fetch desa/kelurahan:', error);
                }
            });
        }
    });

    $('#foto-upload').on('change', function() {
        var file = this.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageData = e.target.result; // This is the base64 image data
                console.log(imageData);
                $("#img-holder").attr("src", imageData);
                // Send the base64 image data to the Laravel controller via Ajax
            };
            reader.readAsDataURL(file);
        }
    });

    if (localStorage.getItem('payloads')) {
        // Remove the item from localStorage
        localStorage.removeItem('payloads');
        console.log('Item deleted from localStorage.');
    } else {
        console.log('Item not found in localStorage.');
    }

    $("#save").on("click", function() {
        var payload = {
            nama: $("#nama").val(),
            tempat_lahir: $("#tempat-lahir").val(),
            tanggal_lahir: $("#tanggal-lahir").val(),
            jenis_kelamin: $("#jenis-kelamin").val(),
            desa_kelurahan_code: $("#desa-kelurahan").val(),
            desa_kelurahan_desc: $("#desa-kelurahan").find('option:selected').text(),
            alamat_lengkap: $("#alamat-lengkap").val(),
            kategori_code: $("#kategori").val(),
            kategori_desc: $("#kategori").find('option:selected').text(),
            organisasi_pembina_code: $("#organisasi-pembina").val(),
            organisasi_pembina_desc: $("#organisasi-pembina").find('option:selected').text(),
            induk_olahraga_code: $("#induk-olahraga").val(),
            induk_olahraga_desc: $("#induk-olahraga").find('option:selected').text(),
            cabang_olahraga_code: $("#cabang-olahraga").val(),
            cabang_olahraga_desc: $("#cabang-olahraga").find('option:selected').text(),
            foto: $("#img-holder").attr("src"),
            lisensi: [],
            prestasi: [],
        };

        // Convert payload to JSON string
        var payloadString = JSON.stringify(payload);

        // Set the JSON string in local storage under a specific key
        localStorage.setItem('payloads', payloadString);

        location.href = "{{route('transaksi.olahraga-masyarakat.create')}}";
    });

    $(document).ready(function() {
        const table = $("#table").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            paging: true,
            pageLength: 10,
            ajax: {
                url: `/transaksi/olahraga-masyarakat/get-lists`,
                type: 'GET',
                data: function(d) {
                    d.custom_search = $('[data-table-filter="search"]').val();
                    d.kecamatan = $('#f-kecamatan').val();
                    d.desa_kelurahan = $('#f-desa-kelurahan').val();
                },
                dataSrc: function(json) {
                    return json.data;
                }
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir'
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'nama_kecamatan',
                    name: 'nama_kecamatan'
                },
                {
                    data: 'nama_desa_kelurahan',
                    name: 'nama_desa_kelurahan'
                },
                {
                    data: 'str_kategori',
                    name: 'str_kategori'
                },
                {
                    data: 'organisasi_pembina',
                    name: 'organisasi_pembina'
                },
                {
                    data: 'nama_induk_olahraga',
                    name: 'nama_cabang_olahraga'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/transaksi/olahraga-masyarakat/detail/${row.id}"> <i
                                        data-lucide="edit" class="w-4 h-4 mr-1"></i> Detail </a>
                                </div>
                            `;
                    }
                }
            ]
        });

        $('[data-table-filter="search"]').on('keyup', function() {
            table.ajax.reload();
        });

        $('#f-kecamatan, #f-desa-kelurahan').on('change', function () {
        table.ajax.reload(); // Trigger DataTable redraw with updated filter values
    });
    });
});
</script>
@endsection
