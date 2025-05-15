@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div
            class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="route('transaksi.keolahragaan.forms.sarana', ['kecamatan' => $kecamatan, 'desa_kelurahan' => $desaKelurahan, 'tahun' => $tahun])"
                    class="w-10 h-10 rounded-full btn btn-primary text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</a>
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
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prestasi Olahraga Masyarakat
                </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.verifikasi-konfirmasi')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">5</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Verifikasi dan Konfirmasi Data</div>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div id="sarana-form" class="grid grid-cols-12 gap-2 gap-y-5 mt-5">
                <div id="form-sarana" class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline">
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Sarana</label>
                        <select type="text" class="form-control" name="sarana_di" id="sarana-id">
                            <option value=" "> - </option>
                            @foreach($sarana as $sr)
                            <option value="{{$sr->id}}">{{$sr->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Tipe Sarana</label>
                        <select type="text" class="form-control" name="tipe_sarana" id="tipe-sarana">
                            <option value=" "> - </option>
                            <option value="1">Indoor</option>
                            <option value="2">Outdoor</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Status Kepemilikan</label>
                        <select type="text" class="form-control" name="status_kepemilikan" id="status-kepemilikan">
                            <option value=" "> - </option>
                            <option value="1">Milik Pribadi</option>
                            <option value="2">Pemerintah</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Nama Pemilik</label>
                        <input type="text" class="form-control" name="nama_pemilik" id="nama-pemilik">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" id="ukuran">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Status Kondisi</label>
                        <select type="text" class="form-control" name="status_kondisi" id="status-kondisi">
                            <option value=" "> - </option>
                            <option value="1">Layak Pakai</option>
                            <option value="2">Tidak Layak Pakai</option>
                        </select>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline">
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Alamat</label>
                        <textarea type="text" class="form-control" name="alamat" id="alamat"></textarea>
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Foto Lokasi 1</label>
                        <input id="input-wizard-1" type="file" class="form-control" name="foto_lokasi_1" id="foto-lokasi-1">
                    </div>
                    <!-- <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="form-label sm:w-40">Foto Lokasi 2</label>
                        <input id="input-wizard-2" type="file" class="form-control" name="foto_lokasi_1" id="foto-lokasi-2">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-1" class="form-label sm:w-40">Foto Lokasi 3</label>
                        <input id="input-wizard-1" type="file" class="form-control" name="foto_lokasi_1" id="foto-lokasi-3">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="input-wizard-2" class="form-label sm:w-40">Foto Lokasi 4</label>
                        <input id="input-wizard-2" type="file" class="form-control" name="foto_lokasi_1" id="foto-lokasi-4">
                    </div> -->
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button class="btn btn-primary w-24 ml-2" id="simpan">Simpan</button>
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
                            <th class="whitespace-nowrap">Ststus Kepemilikan</th>
                            <th class="whitespace-nowrap">Nama Pemilik</th>
                            <th class="whitespace-nowrap">Ukuran</th>
                            <th class="whitespace-nowrap">Status Kondisi</th>
                            <th class="whitespace-nowrap">Latitude</th>
                            <th class="whitespace-nowrap">Longitude</th>
                            <th class="whitespace-nowrap">Alamat</th>
                            <th class="text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sarana-table-body">

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

    populateTable();

    $('#simpan').on('click', function() {

        var dataObject = {
            sarana_code : $('#sarana-id').val(),
            sarana_desc : $('#sarana-id').find('option:selected').text(),
            tipe_sarana_code : $('#tipe-sarana').val(),
            tipe_sarana_desc : $('#tipe-sarana').find('option:selected').text(),
            status_kepemilikan_code : $('#status-kepemilikan').val(),
            status_kepemilikan_desc : $('#status-kepemilikan').find('option:selected').text(),
            nama_pemilik : $('#nama-pemilik').val(),
            ukuran : $('#ukuran').val(),
            status_kondisi_code : $('#status-kondisi').val(),
            status_kondisi_desc : $('#status-kondisi').find('option:selected').text(),
            latitude : $('#longitude').val(),
            longitude : $('#latitude').val(),
            alamat : $('#alamat').val(),
            lampiran_1 : $('#lampiran-1').val(),
            lampiran_2 : $('#lampiran-2').val(),
            lampiran_3 : $('#lampiran-3').val(),
            lampiran_4 : $('#lampiran-4').val(),
        }

        // Retrieve the JSON string from localStorage
        var storedPayloadString = localStorage.getItem('payloads');

        // Convert the JSON string back to an object
        var storedPayload = JSON.parse(storedPayloadString);

        // Push the new dataObject into the sarana array
        storedPayload.sarana.push(dataObject);

        // Convert the updated object back to a JSON string
        var updatedPayloadString = JSON.stringify(storedPayload);

        // Store the updated JSON string back into localStorage
        localStorage.setItem('payloads', updatedPayloadString);

        // Optionally, you can log the updated object to see the changes
        console.log(storedPayload);


        populateTable();
        clearForm()
    });

    function populateTable() {
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

                var deleteButton = $('<button>Delete</button>').click(function() { deleteRow(row); });

                row.append($('<td class="text-center"></td>').append(deleteButton));
                tableBody.append(row);
            });
        }
    }

    function deleteRow(row) {
        var index = row.index();
        row.remove();

        // Check if localStorage has the 'payloads' item
        if (localStorage.getItem('payloads')) {
            // Parse the 'payloads' data from localStorage
            var payloadsData = JSON.parse(localStorage.getItem('payloads'));

            // Check if the 'sarana' property exists and is an array
            if (payloadsData.sarana && Array.isArray(payloadsData.sarana)) {
                // Check if the index is valid
                if (index >= 0 && index < payloadsData.sarana.length) {
                    // Remove the item at the specified index from 'sarana' array
                    payloadsData.sarana.splice(index, 1);

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

    function clearForm() {
        // Reset all form fields to their initial state
        $('#sarana-id').val(' ');
        $('#tipe-sarana').val(' ');
        $('#status-kepemilikan').val(' ');
        $('#nama-pemilik').val('');
        $('#ukuran').val('');
        $('#status-kondisi').val(' ');
        $('#longitude').val('');
        $('#latitude').val('');
        $('#alamat').val('');
        $('#lampiran-1').val('');
        $('#lampiran-2').val('');
        $('#lampiran-3').val('');
        $('#lampiran-4').val('');
    }
});
</script>
@endsection