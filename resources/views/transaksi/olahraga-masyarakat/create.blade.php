@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-10 mt-5">

        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 px-5 sm:px-20">
            <div class="intro-x flex items-left mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button id="confirm-and-save" class="flex items-center ml-auto text-white btn btn-primary shadow-md">konfirmasi & Simpan</button>
            </div>
        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-2 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
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
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Desa / Kelurahan</label>
                        <input type="text" class="form-control" name="desa_kelurahan" id="desa-kelurahan">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat Lengkap</label>
                        <textarea type="text" class="form-control" name="alamat_lengkap" id="alamat-lengkap"></textarea>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline">
                        <label for="horizontal-form-2" class="sm:w-40 font-bold">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="sm:w-40 font-bold">Organisasi Pembina</label>
                        <input type="text" class="form-control" name="organisasi_pembina" id="organisasi-pembina">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="sm:w-40 font-bold">Induk Olahraga</label>
                        <input type="text" class="form-control" name="induk_olahraga" id="induk-olahraga">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Foto</label>
                        <img id="img-holder" src="" style="width:150px; height:150px;"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Wizard Layout -->
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>

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

                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
                        <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">Lisensi</label>
                                    <input type="text" class="form-control" name="lisensi" id="lisensi">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">Kategori</label>
                                    <select data-placeholder="Pilih Kategori" class="tom-select w-full form-control" id="kategori" name="kategori" required>
                                        <option value=" "> - </option>
                                        <option value="1">Daerah</option>
                                        <option value="2">Nasional</option>
                                        <option value="3">Internasional</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-lisensi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
                            </div>
                        </div>
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
                        <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <div class="form-inline">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">prestasi</label>
                                    <input type="text" class="form-control" name="prestasi" id="prestasi">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">Kategori</label>
                                    <select data-placeholder="Pilih Kategori" class="tom-select w-full form-control" id="kategori" name="kategori" required>
                                        <option value=" "> - </option>
                                        <option value="1">Daerah</option>
                                        <option value="2">Nasional</option>
                                        <option value="3">Internasional</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">Peraihan Medali</label>
                                    <select data-placeholder="Pilih Kategori" class="tom-select w-full form-control" id="peraihan-medali" name="peraihan_medali" required>
                                        <option value=" "> - </option>
                                        <option value="1">Emas</option>
                                        <option value="2">Perak</option>
                                        <option value="3">Perunggu</option>
                                    </select>
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="input-wizard-2" class="sm:w-32 font-bold">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
                            </div>
                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-danger py-3 border-slate-300 dark:border-darkmode-400 w-full md:w-52">Batal</button>
                                <button id="save-prestasi" class="btn py-3 btn-primary w-full md:w-52">Simpan</button>
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

    populateInformasiAtlet();
    populateLisensiTable()
    populatePrestasiTable();

    var payloadString = localStorage.getItem('payloads'); // Use the correct key 'payloads'
    var data = JSON.parse(payloadString); // Parse the payload JSON string

    if(data.kategori_code === "1" || data.kategori_code === 1) {
        $("#form-table-lisensi").hide();
    } else {
        $("#form-table-prestasi").hide();
    }

    $("#batal").on('click', function() {
        localStorage.removeItem('payloads');
        console.log('Item deleted from localStorage.');
        location.href = "{{route('transaksi.keolahragaan.index')}}";
    });

    $('#confirm-and-save').on('click', function() {
        // Retrieve the object from localStorage
        const data = JSON.parse(localStorage.getItem('payloads'));

        // Convert the object to JSON string
        const jsonData = JSON.stringify(data);

        // Get the CSRF token from the meta tag in your HTML
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Define your AJAX request using jQuery
        $.ajax({
            url: '{{route("transaksi.olahraga-masyarakat.save")}}', // Replace 'your_api_endpoint' with your actual API endpoint
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
                location.href = "{{route('transaksi.olahraga-masyarakat.index')}}";

            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    $('#save-lisensi').on('click', function() {

        var dataObject = {
            lisensi : $('#form-lisensi #lisensi').val(),
            kategori_code : $('#form-lisensi #kategori').val(),
            kategori_desc : $('#form-lisensi #kategori').find('option:selected').text(),
            tahun : $('#form-lisensi #tahun').val(),
        }

        // Retrieve the JSON string from localStorage
        var storedPayloadString = localStorage.getItem('payloads');

        // Convert the JSON string back to an object
        var storedPayload = JSON.parse(storedPayloadString);

        // Push the new dataObject into the sarana array
        storedPayload.lisensi.push(dataObject);

        // Convert the updated object back to a JSON string
        var updatedPayloadString = JSON.stringify(storedPayload);

        // Store the updated JSON string back into localStorage
        localStorage.setItem('payloads', updatedPayloadString);

        // Optionally, you can log the updated object to see the changes
        console.log(storedPayload);

        populateLisensiTable();
        clearFormLisensi()
        $('[data-tw-dismiss="modal"]').click();
    });

    $('#save-prestasi').on('click', function() {

        var dataObject = {
            prestasi : $('#form-prestasi #prestasi').val(),
            kategori_code : $('#form-prestasi #kategori').val(),
            kategori_desc : $('#form-prestasi #kategori').find('option:selected').text(),
            peraihan_medali_code : $('#form-prestasi #peraihan-medali').val(),
            peraihan_medali_desc : $('#form-prestasi #peraihan-medali').find('option:selected').text(),
            tahun : $('#form-prestasi #tahun').val(),
        }

        // Retrieve the JSON string from localStorage
        var storedPayloadString = localStorage.getItem('payloads');

        // Convert the JSON string back to an object
        var storedPayload = JSON.parse(storedPayloadString);

        // Push the new dataObject into the sarana array
        storedPayload.prestasi.push(dataObject);

        // Convert the updated object back to a JSON string
        var updatedPayloadString = JSON.stringify(storedPayload);

        // Store the updated JSON string back into localStorage
        localStorage.setItem('payloads', updatedPayloadString);

        // Optionally, you can log the updated object to see the changes
        console.log(storedPayload);


        populatePrestasiTable();
        clearFormPrestasi()
        $('[data-tw-dismiss="modal"]').click();
    });

    function populateLisensiTable() {
        var payloadString = localStorage.getItem('payloads'); // Use the correct key 'payloads'
        var payload = JSON.parse(payloadString); // Parse the payload JSON string

        var lisensiData = payload.lisensi; // Get the sarana array from the payload
        console.log(lisensiData);
        var tableBody = $('#lisensi-table-body');
        tableBody.empty();

        if (lisensiData && Array.isArray(lisensiData)) { // Check if saranaData is an array
            lisensiData.forEach(function(data) {
                var row = $('<tr></tr>');
                row.append($('<td></td>').text(data.lisensi));
                row.append($('<td></td>').text(data.kategori_desc));
                row.append($('<td></td>').text(data.tahun));
                var deleteButton = $('<button>Delete</button>').click(function() { deleteRowLisensi(row); });

                row.append($('<td class="text-center"></td>').append(deleteButton));
                tableBody.append(row);
            });
        }
    }

    function populatePrestasiTable() {
        var payloadString = localStorage.getItem('payloads'); // Use the correct key 'payloads'
        var payload = JSON.parse(payloadString); // Parse the payload JSON string

        var prestasiData = payload.prestasi; // Get the sarana array from the payload
        console.log(prestasiData);
        var tableBody = $('#prestasi-table-body');
        tableBody.empty();

        if (prestasiData && Array.isArray(prestasiData)) { // Check if saranaData is an array
            prestasiData.forEach(function(data) {
                var row = $('<tr></tr>');
                row.append($('<td></td>').text(data.prestasi));
                row.append($('<td></td>').text(data.kategori_desc));
                row.append($('<td></td>').text(data.peraihan_medali_desc));
                row.append($('<td></td>').text(data.tahun));
                var deleteButton = $('<button>Delete</button>').click(function() { deleteRowPrestasi(row); });

                row.append($('<td class="text-center"></td>').append(deleteButton));
                tableBody.append(row);
            });
        }
    }

    function populateInformasiAtlet() {
        var payloadString = localStorage.getItem('payloads'); // Use the correct key 'payloads'
        var payload = JSON.parse(payloadString); // Parse the payload JSON string

        $("#nama").val(payload.nama);
        $("#tempat-lahir").val(payload.tempat_lahir);
        $("#tanggal-lahir").val(payload.tanggal_lahir);
        $("#desa-kelurahan").val(payload.desa_kelurahan_desc);
        $("#alamat-lengkap").val(payload.alamat_lengkap);
        $("#kategori").val(payload.kategori_desc);
        $("#organisasi-pembina").val(payload.organisasi_pembina_desc);
        $("#induk-olahraga").val(payload.induk_olahraga_desc);
        $("#cabang-olahraga").val(payload.cabang_olahraga_desc);
        $("#img-holder").attr("src", payload.foto);
        
    }

    function deleteRowLisensi(row) {
        var index = row.index();
        row.remove();

        // Check if localStorage has the 'payloads' item
        if (localStorage.getItem('payloads')) {
            // Parse the 'payloads' data from localStorage
            var payloadsData = JSON.parse(localStorage.getItem('payloads'));

            // Check if the 'kegiatan_olahraga' property exists and is an array
            if (payloadsData.lisensi && Array.isArray(payloadsData.lisensi)) {
                // Check if the index is valid
                if (index >= 0 && index < payloadsData.lisensi.length) {
                    // Remove the item at the specified index from 'sarana' array
                    payloadsData.lisensi.splice(index, 1);

                    // Update the 'payloads' data in localStorage
                    localStorage.setItem('payloads', JSON.stringify(payloadsData));
                } else {
                    console.error('Invalid index for deleting row from payloads data.');
                }
            } else {
                console.error('Invalid or missing "sarana" data in payloads.');
            }
        } else {
            console.error('No "payloads" data found in localStorage.');
        }
    }

    function deleteRowPrestasi(row) {
        var index = row.index();
        row.remove();

        // Check if localStorage has the 'payloads' item
        if (localStorage.getItem('payloads')) {
            // Parse the 'payloads' data from localStorage
            var payloadsData = JSON.parse(localStorage.getItem('payloads'));

            // Check if the 'kegiatan_olahraga' property exists and is an array
            if (payloadsData.prestasi && Array.isArray(payloadsData.prestasi)) {
                // Check if the index is valid
                if (index >= 0 && index < payloadsData.prestasi.length) {
                    // Remove the item at the specified index from 'sarana' array
                    payloadsData.prestasi.splice(index, 1);

                    // Update the 'payloads' data in localStorage
                    localStorage.setItem('payloads', JSON.stringify(payloadsData));
                } else {
                    console.error('Invalid index for deleting row from payloads data.');
                }
            } else {
                console.error('Invalid or missing "sarana" data in payloads.');
            }
        } else {
            console.error('No "payloads" data found in localStorage.');
        }
    }

    function clearFormPrestasi() {
        $('#form-prestasi #prestasi').val(' ');
        $('#form-prestasi #kategori').val(' ');
        $('#form-prestasi #peraihan-medali').val(' ');
        $('#form-prestasi #tahun').val(' ');
    }

    function clearFormLisensi() {
        $('#form-lisensi #lisensi').val(' ');
        $('#form-lisensi #kategori').val(' ');
        $('#form-lisensi #tahun').val(' ');
    }
});
</script>
@endsection