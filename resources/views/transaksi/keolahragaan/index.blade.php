@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Keolahragan
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <div class="flex w-full sm:w-auto">
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
                <input type="text" data-table-filter="search" class="form-control form-control-solid w-xl mr-2 ps-15"
                    placeholder="Cari" />
            </div>
            <div class="hidden xl:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-input"
                    class="btn btn-primary shadow-md mr-2"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>Tambah
                    Data </a>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table -mt-2" id="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Kecamatan</th>
                        <th class="whitespace-nowrap">Desa / Kelurahan</th>
                        <th class="whitespace-nowrap text-center">Jumlah Sarana (Infrastruktur)</th>
                        <th class="whitespace-nowrap text-center">Jumlah Kelompok Olahraga</th>
                        <th class="whitespace-nowrap text-center">Jumlah Prestasi Atlet</th>
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
                                Input Data Keolahragaan
                            </h2>
                        </div>
                        <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="horizontal-form-2" class="sm:w-32 font-bold">Wilayah</label>
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
                                    <label for="vertical-form-1" class="sm:w-32 font-bold">Tahun</label>
                                    <?php
                                        // Get the current year
                                        $current_year = date('Y');
                                        // Calculate the range of years
                                        $years_range = range($current_year - 5, $current_year + 5);
                                    ?>
                                    <select data-placeholder="Pilih Tahun" class="tom-select w-full form-control"
                                        id="tahun" name="tahun" required>
                                        <option value=" "> - </option>
                                        @foreach($years_range as $year)
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        @endforeach
                                    </select>
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
    if (localStorage.getItem('payloads')) {
        // Remove the item from localStorage
        localStorage.removeItem('payloads');
        console.log('Item deleted from localStorage.');
    } else {
        console.log('Item not found in localStorage.');
    }

    $("#save").on("click", function() {
        var payload = {
            kecamatan_code: $("#kecamatan").val(),
            kecamatan_desc: $("#kecamatan").find('option:selected').text(),
            desa_kelurahan_code: $("#desa-kelurahan").val(),
            desa_kelurahan_desc: $("#desa-kelurahan").find('option:selected').text(),
            tahun: $("#tahun").val(),
            sarana: [],
            prasarana: [],
            kegiatan_olahraga: [],
            prestasi_olahraga: []
        };

        // Convert payload to JSON string
        var payloadString = JSON.stringify(payload);

        // Set the JSON string in local storage under a specific key
        localStorage.setItem('payloads', payloadString);

        location.href = "{{route('transaksi.keolahragaan.forms.sarana')}}";
    });
});

$(document).ready(function() {
    const table = $("#table").DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        paging: true, // Enable pagination
        pageLength: 10, // Number of rows per page
        ajax: {
            url: `/transaksi/keolahragaan/get-lists`, // Replace with your route
            type: 'GET',
            data: function(d) {
                d.custom_search = $('[data-table-filter="search"]').val();
                d.kecamatan = $('#f-kecamatan').val();
                d.desa_kelurahan = $('#f-desa-kelurahan').val();
            },
            dataSrc: function(json) {
                return json.data; // Map the 'data' field
            }
        },
        columns: [{
                data: 'nama_kecamatan',
                name: 'nama_kecamatan'
            },
            {
                data: 'nama_desa_kelurahan',
                name: 'nama_desa_kelurahan'
            },
            {
                data: 'jumlah_sarana',
                name: 'jumlah_sarana',
                className: 'text-center'
            },
            {
                data: 'jumlah_kegiatan_olahraga',
                name: 'jumlah_kegiatan_olahraga',
                className: 'text-center'
            },
            {
                data: 'jumlah_kegiatan_olahraga',
                name: 'jumlah_kegiatan_olahraga',
                className: 'text-center'
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
                                        data-lucide="edit" class="w-4 h-4 mr-1"></i> Detail </a>
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/transaksi/keolahragaan/export/${row.id}"> <i
                                        data-lucide="file-text" class="w-4 h-4 mr-1"></i> Export</a>
                            </div>
                        `;
                }
            }
        ]
    });

    $('[data-table-filter="search"]').on('keyup', function() {
        table.ajax.reload(); // Triggers a new AJAX request with the search term
    });

    $('#f-kecamatan, #f-desa-kelurahan').on('change', function () {
        table.ajax.reload(); // Trigger DataTable redraw with updated filter values
    });
});
</script>
@endsection
