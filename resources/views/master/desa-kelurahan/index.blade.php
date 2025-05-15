@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Master Data Desa / Kelurahan
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <div class="flex w-full sm:w-auto">
                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#form-input" class="btn btn-primary shadow-md mr-2"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>Tambah Data </a>
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
                        <th class="whitespace-nowrap">Kecamatan</th>
                        <th class="whitespace-nowrap">Desa / Kelurahan</th>
                        <th class="whitespace-nowrap">Latitude</th>
                        <th class="whitespace-nowrap">Longitude</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete these records?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal"
                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
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
            pageLength: 10,
            ajax: {
                url: `/master/desa-kelurahan/get-lists`,
                type: 'GET',
                data: function (d) {
                    d.custom_search = $('[data-table-filter="search"]').val();
                },
                dataSrc: function (json) {
                    return json.data;
                }
            },
            columns: [
                { data: 'nama_kecamatan', name: 'nama_kecamatan' },
                { data: 'nama', name: 'nama' },
                { data: 'latitude', name: 'latitude'},
                { data: 'longitude', name: 'longitude'},
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/master/desa-kelurahan/edit/${row.id}"> <i
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
