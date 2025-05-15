@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5 sm:px-20">
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.sarana')}}" class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">1</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Sarana </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.prasarana')}}" class="w-10 h-10 rounded-full btn btn-primary text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">2</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prasarana </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.kegiatan-olahraga')}}" class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Kegiatan Olahraga di Masyarakat</div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.prestasi-olahraga')}}" class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">4</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Prestasi Olahraga Masyarakat </div>
            </div>
            <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <a href="{{route('transaksi.keolahragaan.forms.verifikasi-konfirmasi')}}"
                    class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">5</a>
                <div class="lg:w-28 text-base lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Verifikasi dan Konfirmasi Data</div>
            </div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-2 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline"> 
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Nama Prasarana</label>
                        <select type="text" class="form-control" name="prasarana_id" id="prasarana-id"> 
                            <option value=" "> - </option>
                            @foreach($prasarana as $sr)
                            <option value="{{$sr->id}}">{{$sr->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Hibah Dari Pemerintah ?</label>
                        <select type="text" class="form-control" name="status_hibah" id="status-hibah"> 
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah">
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Status Layak</label>
                        <select type="text" class="form-control" name="status_layak" id="status-layak"> 
                            <option value=" "> - </option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak </option>
                        </select>
                    </div>
                    <div class="form-inline mt-5"> 
                        <label for="input-wizard-2" class="sm:w-40 font-bold">Tahun</label>
                        <input type="text" class="form-control" name="tahun" id="tahun">
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 p-5">
                    <div class="form-inline"> 
                        <label for="input-wizard-1" class="sm:w-40 font-bold">Lampiran (Foto)</label>
                        <input type="file" class="form-control" name="lampiran" id="lampiran"> 
                    </div>
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
                            <th class="whitespace-nowrap">Nama Prasrana</th>
                            <th class="whitespace-nowrap text-center">Jumlah</th>
                            <th class="whitespace-nowrap text-center">Layak</th>
                            <th class="whitespace-nowrap">Lampiran</th>
                            <th class="whitespace-nowrap text-center">Tahun</th>
                            <th class="text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="prasarana-table-body">

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
            prasarana_code : $('#prasarana-id').val(),
            prasarana_desc : $('#prasarana-id').find('option:selected').text(),
            jumlah : $('#jumlah').val(),
            status_layak_code : $('#status-layak').val(),
            status_layak_desc : $('#status-layak').find('option:selected').text(),
            tahun : $('#tahun').val(),
            lampiran : $('#lampiran').val(),
        }

        // Retrieve the JSON string from localStorage
        var storedPayloadString = localStorage.getItem('payloads');

        // Convert the JSON string back to an object
        var storedPayload = JSON.parse(storedPayloadString);

        // Push the new dataObject into the sarana array
        storedPayload.prasarana.push(dataObject);

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

            // Check if the 'prasarana' property exists and is an array
            if (payloadsData.prasarana && Array.isArray(payloadsData.prasarana)) {
                // Check if the index is valid
                if (index >= 0 && index < payloadsData.prasarana.length) {
                    // Remove the item at the specified index from 'sarana' array
                    payloadsData.prasarana.splice(index, 1);

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
        $('#prasarana-id').val(' ');
        $('#jumlah').val(' ');
        $('#status-layak').val(' ');
        $('#lampiran').val('');
        $('#tahun').val('');
    }
});

</script>
@endsection