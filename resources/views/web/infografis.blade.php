@extends('layouts._base')
@section('style')
<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 100%;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>
@endsection

@section('content')
<!-- Hero Start -->
<div class="container-fluid pt-5 bg-primary hero-header">
    <div class="container pt-5">
        <div class="row g-5 pt-5">
            <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5">
                <h1 class="display-4 text-white mb-4 animated slideInRight">Infrastruktur Keolahragaan</h1>
                <p class="text-white mb-4 animated slideInRight">Data sarana , prasarana, kegiatan keolahragaan dan Prestasi Keolahragaan di Kabupaten Bandung</p>
            </div>
            <div class="col-lg-6 align-self-end text-center text-lg-end">
                <img class="img-fluid" src="img/hero-img.png" alt="" style="max-height: 300px;">
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Feature Start -->
<div class="container bg-white py-5">
    <div class="container-fluid">
        <h5 class="mb-3">Ringkasan Data</h5>
        <div class="row mb-2">
            <div class="col-lg-3">
                <div class="d-flex flex-column border mb-3 rounded-3">
                    <div class="p-2">
                        <h5>Kecamatan</h5>
                        <h3 id="kecamatan">0</h3>
                        <div class="form-text">Data Tahun 2023</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column border mb-3 rounded-3">
                    <div class="p-2">
                        <h5>Infrastruktur Olahraga</h5>
                        <h3 id="infrastruktur-keolahragaan">0</h3>
                        <div class="form-text">Data Tahun 2023</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column border mb-3 rounded-3">
                    <div class="p-2">
                        <h5>Kelompok Olahraga</h5>
                        <h3 id="kelompok-olahraga">0</h3>
                        <div class="form-text">Data Tahun 2023</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column border mb-3 rounded-3">
                    <div class="p-2">
                        <h5>Prestasi Atlet</h5>
                        <h3 id="prestasi-atlet">0</h3>
                        <div class="form-text">Data Tahun 2023</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </div>

        <h5 class="mb-3">filter Data Keolahragaan</h5>
        <div class="row">
            <div class="col-lg-3 mb-3 wow fadeIn" data-wow-delay="0.3s">
                <form class="border p-2">
                    <!-- <h5>Filter Data</h5> -->
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                        <select class="form-control" id="slc-kecamatan">
                            <option value=" " selected>-</option>
                            @foreach($wilayah as $wil)
                            <option value="{{$wil->id}}"><?php echo ucfirst(strtolower($wil->nama)); ?></option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <button type="submit" class="col-12 btn btn-primary ">Pratinjau</button> -->
                </form>
            </div>
            <div class="col-lg-9 align-self-center mb-md-5 pb-md-5 wow fadeIn mb-3" data-wow-delay="0.3s">
                <div class="p-2 border">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container">
        <div class="row">
            <div class="col-lg-12 align-self-center mb-md-5 pb-md-5 wow fadeIn mb-3" data-wow-delay="0.3s">

            </div>
        </div>
    </div> -->
</div>
<!-- Feature End -->
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
$(document).ready(function() {

    renderChart(categories = [], data = []);

    $("#slc-kecamatan").change(function() {
        var kecamatan_id = $(this).val();
        $.ajax({
            url: `/api/v1/infrastruktur-olahraga/get-fasilitas-per-desa-kelurahan-filter-by-kecamatan/?kecamatan_id=${kecamatan_id}`,
            method: 'GET',
            dataType: 'json',
                success: function(response) {
                    // Handle the response data
                    var categories = response.data.map(item => item.nama_sarana);
                    var data = response.data.map(item => item.jumlah);

                    renderChart(categories, data);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(status, error);
                }
        });

    });

    $.ajax({
        url: '/api/v1/infrastruktur-olahraga/get-total-kecamatan',
        method: 'GET',
        dataType: 'json',
            success: function(response) {
                // Handle the response data
                $('#kecamatan').text(response.data.total_kecamatan);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(status, error);
            }
    });

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
        url: '/api/v1/infrastruktur-olahraga/get-summary-data-kelolahragaan',
        method: 'GET',
        dataType: 'json',
            success: function(response) {
                // Handle the response data
                console.log(response.data);
                renderMap(response.data);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(status, error);
            }
    });


});


function renderMap(data) {
    var map = L.map('map').setView([-7.021896552663677, 107.5277945169024], 11); // Koordinat pusat peta

    // Tambahkan layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Tambahkan marker untuk setiap kecamatan
    data.forEach(function(item) {
      var marker = L.marker([item.latitude, item.longitude]).addTo(map);
      var popup_string =`<div>
                            <b>Kecamatan:</b> ${item.kecamatan} <br><b>Fasilitas Olahraga:</b> ${item.sarana} <br><b>Kelompok Olahraga:</b> ${item.kelompok_olahraga}
                        </div>`;
      marker.bindPopup(popup_string).openPopup();
    });
}

function renderChart(categories, data) {
    Highcharts.chart('container', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik jumlah Infrastruktur Keolahragaan Per Kecamatan',
            align: 'left'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: categories,
            labels: {
                skew3d: true,
                style: {
                    fontSize: '13px'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Jumlah Infrastruktur Keolahragaan',
                margin: 20
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        series: [{
            name: 'Jumlah Fasilitas ',
            data: data
        }]
    });
}

</script>
@endsection
