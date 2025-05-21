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
                <h1 class="display-4 text-white mb-4 animated slideInRight">Olahraga Masyarakat</h1>
                <p class="text-white mb-4 animated slideInRight">Data Olaharaga Prestasi KORMI</p>
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
            <div class="col-lg-6">
                <div class="d-flex flex-column border mb-3 rounded-3 justify-content-center align-items-center text-center">
                    <div class="p-2">
                        <h3 id="kormi-atlet">0</h3>
                        <h6 class="font-weight-bold">Jumlah Atlet</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex flex-column border mb-3 rounded-3 justify-content-center align-items-center text-center">
                    <div class="p-2">
                        <h3 id="kormi-pelatih">0</h3>
                        <h6 class="font-weight-bold">Jumlah Pelatih</h6>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="mb-3">filter Olahraga Masyarakat</h5>
        <div class="row">
            <div class="col-lg-3 mb-3 wow fadeIn" data-wow-delay="0.3s">
                <form class="border p-2">
                    <!-- <h5>Filter Data</h5> -->
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                        <select class="form-control" name="kecamatan_id" id="slc-kecamatan">
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 align-self-center mb-md-5 pb-md-5 wow fadeIn mb-3" data-wow-delay="0.3s">

            </div>
        </div>
    </div>
</div>
<!-- Feature End -->
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
$(document).ready(function(){

    var defaultParam = {
        "categories": [],
        "series": [
            {
                "name": "Atlet",
                "data": []
            },
            {
                "name": "Pelatih",
                "data": []
            }
        ]
    }

    renderChart(defaultParam);

    $("#slc-kecamatan").change(function() {
        var kecamatan_id = $(this).val();
        $.ajax({
            url: "{{ route('get-data-olahraga-masyarakat-group-by-desa-kelurahan') }}",
            method: 'GET',
            data: { kecamatan_id: kecamatan_id },
            dataType: 'json',
            success: function(response) {
                // Handle the response data
                renderChart(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(status, error);
            }
        });
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
})

function renderChart(chartData) {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik jumlah Atlet dan Pelatih group by kecamatan',
            align: 'left'
        },
        subtitle: {
            align: 'left'
        },
        xAxis: {
            categories: chartData.categories,
            crosshair: true,
            accessibility: {
                description: 'Desa / Kelurahan'
            },
            labels: {
                rotation: -45, // Rotate the x-axis labels at an angle
                align: 'right',
                style: {
                    fontSize: '12px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Penggerak Olahraga'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: chartData.series
    });
}
</script>
@endsection
