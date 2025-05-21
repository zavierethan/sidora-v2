@extends('layouts.admin')
@section('content')
<div class="content content--top-nav">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Infrastruktur, Kegiatan dan Prestasi Keolahragaan
                        </h2>
                        <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw"
                                class="w-4 h-4 mr-3"></i> Reload Data </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-primary"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6" id="infrastruktur-keolahragaan">0
                                    </div>
                                    <div class="text-base text-slate-500 mt-1">Total Sarana</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-warning"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6" id="kelompok-olahraga">0</div>
                                    <div class="text-base text-slate-500 mt-1">Kelompok Olahraga</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-success"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6" id="prestasi-atlet">0</div>
                                    <div class="text-base text-slate-500 mt-1">Prestasi Atlet</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Olahraga Prestasi</h2>
                        <a href="#" class="ml-auto flex items-center text-primary">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-2"></i> Reload Data
                        </a>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <!-- KONI -->
                        <div class="col-span-12 sm:col-span-6 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <h5 class="text-lg font-semibold text-center mb-6">KONI</h5>
                                    <div class="flex justify-between text-center">
                                        <div class="flex-1">
                                            <h3 id="koni-pelatih" class="text-2xl font-bold text-gray-800" id="koni-pelatih">0</h3>
                                            <p class="text-sm text-gray-600 mt-1">Pelatih</p>
                                        </div>
                                        <div class="flex-1">
                                            <h3 id="koni-atlet" class="text-2xl font-bold text-gray-800" id="koni-atlet">0</h3>
                                            <p class="text-sm text-gray-600 mt-1">Atlet</p>
                                        </div>
                                        <div class="flex-1">
                                            <h3 id="koni-wasit" class="text-2xl font-bold text-gray-800" id="koni-wasit">0</h3>
                                            <p class="text-sm text-gray-600 mt-1">Wasit - Juri</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- NPCI -->
                        <div class="col-span-12 sm:col-span-6 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <h5 class="text-lg font-semibold text-center mb-6">NPCI</h5>
                                    <div class="flex justify-between text-center">
                                        <div class="flex-1">
                                            <h3 id="npci-pelatih" class="text-2xl font-bold text-gray-800" id="koni-pelatih">0</h3>
                                            <p class="text-sm text-gray-600 mt-1">Pelatih</p>
                                        </div>
                                        <div class="flex-1">
                                            <h3 id="npci-atlet" class="text-2xl font-bold text-gray-800" id="koni-atlet">0</h3>
                                            <p class="text-sm text-gray-600 mt-1">Atlet</p>
                                        </div>
                                        <div class="flex-1">
                                            <h3 id="npci-wasit" class="text-2xl font-bold text-gray-800" id="koni-wasit">0</h3>
                                            <p class="text-sm text-gray-600 mt-1">Wasit - Juri</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Olahraga Masyarakat
                        </h2>
                        <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw"
                                class="w-4 h-4 mr-3"></i> Reload Data </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-primary"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6" id="kormi-atlet">0</div>
                                    <div class="text-base text-slate-500 mt-1">Atlet</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-pending"></i>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6" id="kormi-pelatih">0</div>
                                    <div class="text-base text-slate-500 mt-1">Pelatih</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Pendaftaran
                        </h2>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-5">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="whitespace-nowrap">Nama Lengkap</th>
                                    <th class="whitespace-nowrap">Email</th>
                                    <th class="whitespace-nowrap">No. Telepon</th>
                                    <th class="whitespace-nowrap">Jenis Akun</th>
                                    <th class="whitespace-nowrap">Kecamatan</th>
                                    <th class="whitespace-nowrap">Desa / Kelurahan</th>
                                    <th class="whitespace-nowrap text-center">Status</th>
                                    <th class="whitespace-nowrap text-center">Tanggal Pendafataran</th>
                                    <th class="text-center whitespace-nowrap">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td class="whitespace-nowrap">{{$item->nama_lengkap}}</td>
                                    <td class="whitespace-nowrap">{{$item->email}}</td>
                                    <td class="whitespace-nowrap">{{$item->no_telepon}}</td>
                                    <td class="whitespace-nowrap">{{$item->nama_role}}</td>
                                    <td class="whitespace-nowrap">{{$item->nama_kecamatan}}</td>
                                    <td class="whitespace-nowrap">{{$item->nama_desa_kelurahan}}</td>
                                    <td class="whitespace-nowrap text-center">{{$item->str_status}}</td>
                                    <td class="whitespace-nowrap text-center">{{$item->tanggal_pendaftaran}}</td>
                                    <td class="table-report__action">
                                        <div class="flex justify-center items-center">
                                            <a class="flex items-center text-primary whitespace-nowrap mr-5"
                                                href="/transaksi/pengaturan/registartions/approve/{{$item->id}}"> <i
                                                    data-lucide="edit" class="w-4 h-4 mr-1"></i> Approve Pendaftaran
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                @if ($data->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link" aria-hidden="true"><i class="w-4 h-4"
                                            data-lucide="chevrons-left"></i></span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev"><i
                                            class="w-4 h-4" data-lucide="chevron-left"></i></a>
                                </li>
                                @endif

                                <!-- Pagination Elements -->
                                @foreach ($data->getUrlRange(max(1, $data->currentPage() - 2), min($data->lastPage(),
                                $data->currentPage() + 2)) as $page => $url)
                                <li class="page-item @if($page == $data->currentPage()) active @endif">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                                @endforeach

                                <!-- Next Page Link -->
                                @if ($data->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next"><i class="w-4 h-4"
                                            data-lucide="chevron-right"></i></a>
                                </li>
                                @else
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link" aria-hidden="true"><i class="w-4 h-4"
                                            data-lucide="chevrons-right"></i></span>
                                </li>
                                @endif
                            </ul>
                        </nav>
                        <p class="pagination-text">Halaman {{ $data->currentPage() }} Dari {{ $data->lastPage() }}</p>
                    </div>
                </div>
                <!-- END: Weekly Top Products -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

$.ajax({
    url: '/api/v1/infrastruktur-olahraga/get-total-sarana',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        // Handle the response data
        $('#infrastruktur-keolahragaan').text(response.data.total_sarana);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(status, error);
    }
});

$.ajax({
    url: '/api/v1/infrastruktur-olahraga/get-total-kelompok-olahraga',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        // Handle the response data
        $('#kelompok-olahraga').text(response.data.total_kelompok_olahraga);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(status, error);
    }
});

$.ajax({
    url: '/api/v1/olahraga-prestasi/get-total-summary',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        // Handle the response data
        $('#prestasi-atlet').text(response.data);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(status, error);
    }
});

$.ajax({
    url: '/api/v1/olahraga-prestasi/get-summary-data-koni',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        // Handle the response data
        console.log(response.data[0].jumlah_atlet)
        $('#koni-atlet').text(response.data[0].jumlah_atlet);
        $('#koni-pelatih').text(response.data[0].jumlah_pelatih);
        $('#koni-wasit').text(response.data[0].jumlah_wasit);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(status, error);
    }
});

$.ajax({
    url: '/api/v1/olahraga-prestasi/get-summary-data-npci',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        // Handle the response data
        $('#npci-atlet').text(response.data[0].jumlah_atlet);
        $('#npci-pelatih').text(response.data[0].jumlah_pelatih);
        $('#npci-wasit').text(response.data[0].jumlah_wasit);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(status, error);
    }
});

$.ajax({
    url: '/api/v1/olahraga-masyarakat/get-summary-data-kormi',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        // Handle the response data
        $('#kormi-atlet').text(response.data[0].jumlah_atlet);
        $('#kormi-pelatih').text(response.data[0].jumlah_pelatih);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(status, error);
    }
});
</script>
@endsection
