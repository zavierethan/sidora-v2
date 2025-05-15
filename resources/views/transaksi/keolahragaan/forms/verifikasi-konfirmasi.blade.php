@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.sarana')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Sarana </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.prasarana')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prasarana
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.kegiatan-olahraga')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Kegiatan
                    Olahraga di Masyarakat</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.prestasi-olahraga')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">4</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prestasi
                    Olahraga Masyarakat
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.verifikasi-konfirmasi')}}"
                    class="w-10 h-10 rounded-full btn btn-primary text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">5</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Verifikasi dan
                    Konfirmasi Data</div>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-2 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-32 font-bold">Wilayah</label>
                        <input type="text" class="form-control" id="desa-kelurahan-desc" readonly>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-32 font-bold">Tahun</label>
                        <input type="text" class="form-control" id="tahun" readonly>
                    </div>
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button class="btn btn-danger ml-2" id="batal">Batal</button>
                    <button class="btn btn-primary ml-2" id="simpan">Konfirmasi & Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
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
                        </tr>
                    </thead>
                    <tbody id="sarana-table-body">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Nama Prasrana</th>
                            <th class="whitespace-nowrap text-center">Jumlah</th>
                            <th class="whitespace-nowrap text-center">Status Layak</th>
                            <th class="whitespace-nowrap">Lampiran</th>
                            <th class="whitespace-nowrap text-center">Tahun</th>
                        </tr>
                    </thead>
                    <tbody id="prasarana-table-body">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Cabang olahraga</th>
                            <th class="whitespace-nowrap">Nama Kelompok (Klub)</th>
                            <th class="whitespace-nowrap">Nama Ketua Klub</th>
                            <th class="whitespace-nowrap text-center">Jumlah Anggota</th>
                            <th class="whitespace-nowrap text-center">Terverifikasi</th>
                            <th class="whitespace-nowrap">Nomor SK</th>
                            <th class="whitespace-nowrap">Alamat Sekretariat</th>
                        </tr>
                    </thead>
                    <tbody id="kegitaan-olahraga-table-body">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="px-5 sm:px-20 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5">
                <table class="table table-report col-span-12 -mt-2">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">Nama Kelompok (Klub)</th>
                            <th class="whitespace-nowrap">Cabang Olahraga</th>
                            <th class="whitespace-nowrap">Prestasi Yang di Raih</th>
                            <th class="whitespace-nowrap">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(function() {

    populateSranaTable()
    populatePrasaranaTable()
    populateKegiatanOlahragaTable();

    $("#batal").on('click', function() {
        localStorage.removeItem('payloads');
        console.log('Item deleted from localStorage.');
        location.href = "{{route('transaksi.keolahragaan.index')}}";
    });

    $('#simpan').on('click', function() {
        // Retrieve the object from localStorage
        const data = JSON.parse(localStorage.getItem('payloads'));

        // Convert the object to JSON string
        const jsonData = JSON.stringify(data);

        // Get the CSRF token from the meta tag in your HTML
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Define your AJAX request using jQuery
        $.ajax({
            url: '{{route("transaksi.keolahragaan.save")}}', // Replace 'your_api_endpoint' with your actual API endpoint
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
            },
            data: jsonData,
            success: function(response) {
                console.log('Data sent successfully:', response);
                localStorage.removeItem('payloads');
                console.log('Item deleted from localStorage.');
                location.href = "{{route('transaksi.keolahragaan.index')}}";
                
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    function populateSranaTable() {
        var payloadString = localStorage.getItem('payloads'); // Use the correct key 'payloads'
        var payload = JSON.parse(payloadString); // Parse the payload JSON string

        var saranaData = payload.sarana; // Get the sarana array from the payload
        console.log(saranaData);
        var tableBody = $('#sarana-table-body');
        tableBody.empty();

        if (saranaData && Array.isArray(saranaData)) { // Check if saranaData is an array
            saranaData.forEach(function(data) {
                var row = $('<tr></tr>');
                row.append($('<td></td>').text(data.sarana_desc));
                row.append($('<td></td>').text(data.tipe_sarana_desc));
                row.append($('<td></td>').text(data.status_kepemilikan_desc));
                row.append($('<td></td>').text(data.nama_pemilik));
                row.append($('<td></td>').text(data.ukuran));
                row.append($('<td></td>').text(data.status_kondisi_desc));
                row.append($('<td></td>').text(data.latitude));
                row.append($('<td></td>').text(data.longitude));
                row.append($('<td></td>').text(data.alamat));
                tableBody.append(row);
            });
        }
    }

    function populatePrasaranaTable() {
        var payloadString = localStorage.getItem('payloads'); // Use the correct key 'payloads'
        var payload = JSON.parse(payloadString); // Parse the payload JSON string

        var prasaranaData = payload.prasarana; // Get the sarana array from the payload
        console.log(prasaranaData);
        var tableBody = $('#prasarana-table-body');
        tableBody.empty();

        if (prasaranaData && Array.isArray(prasaranaData)) { // Check if saranaData is an array
            prasaranaData.forEach(function(data) {
                var row = $('<tr></tr>');
                row.append($('<td></td>').text(data.prasarana_desc));
                row.append($('<td class="text-center"></td>').text(data.jumlah));
                row.append($('<td class="text-center"></td>').text(data.status_layak_desc));
                row.append($('<td></td>').text("-"));
                row.append($('<td class="text-center"></td>').text(data.tahun));
                tableBody.append(row);
            });
        }
    }

    function populateKegiatanOlahragaTable() {
        var payloadString = localStorage.getItem('payloads'); 
        var payload = JSON.parse(payloadString); 
        console.log(payload.kecamatan_desc);

        $("#kecamatan-desc").val(payload.kecamatan_desc);
        $("#desa-kelurahan-desc").val(payload.desa_kelurahan_desc);
        $("#tahun").val(payload.tahun);

        var kegiatanOlahragaData = payload.kegiatan_olahraga; // Get the sarana array from the payload
        console.log(kegiatanOlahragaData);
        var tableBody = $('#kegitaan-olahraga-table-body');
        tableBody.empty();

        if (kegiatanOlahragaData && Array.isArray(kegiatanOlahragaData)) { // Check if saranaData is an array
            kegiatanOlahragaData.forEach(function(data) {
                var row = $('<tr></tr>');
                row.append($('<td></td>').text(data.cabang_olahraga_desc));
                row.append($('<td></td>').text(data.nama_kelompok));
                row.append($('<td></td>').text(data.nama_ketua_kelompok));
                row.append($('<td class="text-center"></td>').text(data.jumlah_anggota));
                row.append($('<td class="text-center"></td>').text(data.terverifikasi_desc));
                row.append($('<td></td>').text(data.nomor_sk));
                row.append($('<td></td>').text(data.alamat_sekretariat));

                tableBody.append(row);
            });
        }
    }
});
</script>
@endsection