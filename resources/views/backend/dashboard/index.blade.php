@extends('layout.backend')

@section('title', 'Dashboard')
@section('page', 'Dashboard')
@section('sub_page', 'Dashboard Analytics')

@push('css')
<link href="{{asset('/')}}src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-8" style="height: 100vh;">
            <div id="s-line" class=""></div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="{{asset('/')}}src/plugins/src/apex/apexcharts.min.js"></script>
<script>
    const booking = JSON.parse(`@json($data)`);

    var sline = {
        chart: {
            fontFamily: 'Nunito, Arial, sans-serif',
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        series: [{
            name: "Vehicle",
            data: booking
        }],
        title: {
            text: 'Vehicles Usage',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#3b3f5c', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', "Dec"],
        }
    }

    // Simple Line

    var simpleLine = new ApexCharts(
        document.querySelector("#s-line"),
        sline
    );

    simpleLine.render();
</script>
@endpush