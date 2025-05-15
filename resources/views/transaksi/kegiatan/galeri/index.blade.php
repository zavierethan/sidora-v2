@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Galeri Kegiatan
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <div class="flex w-full sm:w-auto">
                <a href="{{route('kegiatan.galeri.create')}}" class="btn btn-primary shadow-md mr-2"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>Tambah Data </a>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="Cari" />
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table -mt-2" id="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Judul</th>
                        <th class="whitespace-nowrap">Ringkasan</th>
                        <th class="whitespace-nowrap">Tanggal</th>
                        <!-- <th class="whitespace-nowrap">Tanggal</th> -->
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        const table = $("#table").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            paging: true,
            pageLength: 20,
            ajax: {
                url: `/kegiatan/galeri/get-lists`,
                type: 'GET',
                data: function (d) {
                    d.custom_search = $('[data-table-filter="search"]').val();
                },
                dataSrc: function (json) {
                    return json.data;
                }
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'summary', name: 'summary' },
                { data: 'created_at', name: 'created_at'},
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/kegiatan/galeri/edit/${row.id}"> <i
                                        data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                            </div>
                        `;
                    }
                }
            ]
        });

        $('[data-table-filter="search"]').on('keyup', function () {
            table.ajax.reload();
        });
    });
</script>
@endsection
