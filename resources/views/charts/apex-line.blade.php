@extends('layouts.vertical', ['page_title' => 'Apex Line', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">KZS</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Apex</a></li>
                        <li class="breadcrumb-item active">Line Charts</li>
                    </ol>
                </div>
                <h4 class="page-title">Line Charts</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Simple line chart</h4>
                    <div>
                        <div id="line-chart" class="apex-charts" data-colors="#ffbc00"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Line with Data Labels</h4>
                    <div>
                        <div id="line-chart-datalabel" class="apex-charts" data-colors="#6c757d,#3e60d5"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Zoomable Timeseries</h4>
                    <div>
                        <div id="line-chart-zoomable" class="apex-charts" data-colors="#fa5c7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Line Chart with Annotations</h4>
                    <div>
                        <div id="line-chart-annotations" class="apex-charts" data-colors="#39afd1"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Syncing charts</h4>
                    <div id="line-chart-syncing2" data-colors="#3e60d5"></div>
                    <div>
                        <div id="line-chart-syncing" class="apex-charts" data-colors="#6c757d"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Gradient Line Chart</h4>
                    <div>
                        <div id="line-chart-gradient" class="apex-charts"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Missing / Null values</h4>
                    <div>
                        <div id="line-chart-missing" class="apex-charts" data-colors="#ffbc00,#47ad77,#39afd1"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Dashed Line Chart</h4>
                    <div>
                        <div id="line-chart-dashed" class="apex-charts" data-colors="#6c757d,#47ad77,#39afd1"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Stepline Chart</h4>
                    <div>
                        <div id="line-chart-stepline" class="apex-charts" data-colors="#47ad77"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Brush Chart</h4>
                    <div>
                        <div id="chart-line2" class="apex-charts" data-colors="#3e60d5"></div>
                        <div id="chart-line" class="apex-charts" data-colors="#39afd1"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Realtime Chart</h4>
                    <div>
                        <div id="line-chart-realtime" class="apex-charts" data-colors="#39afd1"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->
@endsection

@section('script')
<!-- Apex Chart Column Demo js -->
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
@vite(['resources/js/pages/demo.apex-line.js'])
@endsection
