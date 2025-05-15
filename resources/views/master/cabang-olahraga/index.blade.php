@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Master Data Cabang Olahraga
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
                        <th class="whitespace-nowrap">Nama</th>
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
    <div id="form-input" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- BEGIN: Horizontal Form -->
                    <form action="{{route('master.cabang-olahraga.save')}}" method="POST" class="intro-y box">
                        @csrf
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Form Input Cabang Olahraga
                            </h2>
                        </div>
                        <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-40 font-bold">Cabang Olahraga</label>
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </div>
                    </form>
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
    $(document).ready(function () {
        const table = $("#table").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            paging: true,
            pageLength: 10,
            ajax: {
                url: `/master/cabang-olahraga/get-lists`,
                type: 'GET',
                data: function (d) {
                    d.custom_search = $('[data-table-filter="search"]').val();
                },
                dataSrc: function (json) {
                    return json.data;
                }
            },
            columns: [
                { data: 'nama', name: 'nama' },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="/master/cabang-olahraga/edit/${row.id}"> <i
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
