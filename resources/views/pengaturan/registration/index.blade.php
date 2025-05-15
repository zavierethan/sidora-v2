@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <h2 class="intro-y text-lg font-medium mt-10">
        Pendaftaran
    </h2>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        @if (Session::has('msg'))
            <div class="alert alert-primary alert-dismissible show flex items-center mt-5" role="alert"> <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> {{ Session::get('msg') }} <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button> </div>
        @endif
        </div>
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table -mt-2" id="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">Nama Lengkap</th>
                        <th class="whitespace-nowrap">Email</th>
                        <th class="whitespace-nowrap">No. Telepon</th>
                        <th class="whitespace-nowrap">Jenis Akun</th>
                        <th class="whitespace-nowrap text-center">Status</th>
                        <th class="whitespace-nowrap text-center">Tanggal Pendafataran</th>
                        <th class="whitespace-nowrap text-center">Tanggal Approve</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                </tbody>
            </table>
        </div>
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
        paging: true, // Enable pagination
        pageLength: 20, // Number of rows per page
        ajax: {
            url: `/transaksi/pengaturan/registartions/get-lists`, // Replace with your route
            type: 'GET',
            data: function (d) {
                d.custom_search = $('[data-table-filter="search"]').val();
            },
            dataSrc: function (json) {
                return json.data; // Map the 'data' field
            }
        },
        columns: [
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'email', name: 'email' },
            { data: 'no_telepon', name: 'no_telepon' },
            { data: 'nama_role', name: 'nama_role' },
            {
                data: 'str_status',
                name: 'str_status',
                className: 'text-center',
            },
            { data: 'tanggal_pendaftaran', name: 'tanggal_pendaftaran', className: 'text-center', },
            { data: 'tanggal_approve', name: 'tanggal_approve', className: 'text-center'},
            {
                data: null, // No direct field from the server
                name: 'action',
                orderable: false, // Disable ordering for this column
                searchable: false, // Disable searching for this column
                clasName: 'text-center',
                render: function (data, type, row) {
                    let elem = "";

                    if(row.status === 0) {
                        elem = `<div class="flex justify-center items-center"><a class="flex items-center text-primary whitespace-nowrap mr-5" href="/transaksi/pengaturan/registartions/approve/${row.id}"> <i
                                        data-lucide="check" class="w-4 h-4 mr-1"></i> Approve Pendaftaran </a></div>`;
                    }

                    if(row.status === 1) {
                        elem = `<div class="flex justify-center items-center"><a class="flex items-center text-success whitespace-nowrap mr-5" href=""> <i data-lucide="check" class="w-4 h-4 mr-1"></i> Approved</a></div>`;
                    }

                    return elem;
                }
            }
        ]
    });

    $('[data-table-filter="search"]').on('keyup', function () {
        table.ajax.reload(); // Triggers a new AJAX request with the search term
    });
});
</script>
@endsection
