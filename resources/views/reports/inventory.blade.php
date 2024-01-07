@extends('layouts.vertical', ['page_title' => 'Reports', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@vite([
'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
'node_modules/daterangepicker/daterangepicker.css',
'node_modules/flatpickr/dist/flatpickr.min.css'
])

<style>
    @print {
        .d-print-none {
            display: none;
        }
    }

</style>
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row d-print-none">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">KZS</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                        <li class="breadcrumb-item active">Inventory Reports</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <i class="ri-calendar-event-line  me-1"></i> Inventory Reports
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <h4 class="header-title mt-2">
        Report Summery
    </h4>
    <div class="row mb-2">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Total Items
                    </h4>
                    <h2 class="">
                        {{ $inventory->count() }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Total Purchase Amount
                    </h4>
                    <h2 class="">
                        €{{ collect($inventory)->sum(function ($item) {
                            return ($item->sold_quantity + $item->quantity) * $item->purchase_price;
                        }) }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Total Sells Amount
                    </h4>
                    <h2 class="">
                        €{{ collect($inventory)->sum(function ($item) {
                            return $item->sold_quantity * $item->product->sale_price;
                        }) }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Total Profit
                    </h4>
                    <h2 class="">
                        €{{ collect($inventory)->sum(function ($item) {
                            return $item->sold_quantity * ($item->product->sale_price - $item->purchase_price);
                        }) }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Inventory Reports <span class="badge bg-soft-success text-success ms-2">
                            {{ $inventory->count() }}
                    </h4>
                    <p class="text-muted fs-14">
                        Here is the list of all inventory reports.
                    </p>

                   <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>S/L</th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Purchase Amount (per unit)
                                </th>
                                <th>
                                    Available Quantity
                                </th>
                                <th>
                                    Sold Quantity
                                </th>
                                <th class="text-end">
                                    Total Sells Amount
                                </th>
                                <th class="text-end">
                                    Total Profit
                                </th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($inventory as $item)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $item->product->name }}
                                </td>
                                <td>
                                    €{{ $item->purchase_price }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    {{ $item->sold_quantity }}
                                </td>
                                <td class="text-end">
                                    €{{ $item->sold_quantity * $item->product->sale_price }}
                                </td>
                                <td class="text-end">
                                    €{{ $item->sold_quantity * ($item->product->sale_price - $item->purchase_price) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->



</div> <!-- container -->
@endsection

@section('script')
@vite(['resources/js/pages/demo.datatable-init.js'])
@vite(['resources/js/pages/demo.form-advanced.js'])
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Add an event listener to the date range picker to update the hidden input field
    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        // Format the date range as needed before setting it to the hidden input
        var formattedDateRange = picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD');
        // $('#date_range').val(formattedDateRange);
        console.log(formattedDateRange);
    });

</script>

<script>
    function validateForm() {
        var startDate = document.getElementById('humanfd-start-date').value;
        var endDate = document.getElementById('humanfd-end-date').value;

        if (!startDate || !endDate) {
            Swal.fire({
                icon: 'error'
                , title: 'Oops...'
                , text: 'Please select a date range!'
            , })
            return false;
        }

        // You can add more validation if needed

        return true;
    }

</script>

@endsection
