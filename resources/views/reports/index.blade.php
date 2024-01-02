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
                        <li class="breadcrumb-item active">Order Reports</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <i class="ri-calendar-event-line  me-1"></i> Order Reports
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Select Date Range
                    </h4>
                    <form method="POST" action="{{ route('second', ['reports', 'date-range']) }}" class="row align-items-lg-end" onsubmit="return validateForm()">
                        @csrf
                        <div class="col-lg-5">
                            <!-- Date Range -->
                            <div class="mt-2">
                                <label class="form-label">Start Date</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="ri-calendar-2-line"></i></span>
                                    <input type="text" name="start-date" id="humanfd-start-date" class="form-control" placeholder="Select Start Date" required>
                                    {{-- <input type="text" class="form-control date" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning"> --}}
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5">
                            <!-- Date Range -->
                            <div class="mt-2">
                                <label class="form-label">End Date</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="ri-calendar-2-line"></i></span>
                                    <input type="text" name="end-date" id="humanfd-end-date" class="form-control" placeholder="Select End Date" required>
                                    {{-- <input type="text" class="form-control date" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning"> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary form-control">
                                <i class="ri-search-line"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Order Reports <span class="badge bg-soft-success text-success ms-2">
                            {{ $orders->count() }}
                    </h4>
                    <p class="text-muted fs-14">
                        Here is the list of all orders. You can filter the orders by date range.
                    </p>

                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>S/L</th>
                                <th>Placed On</th>
                                <th>Items</th>
                                <th>
                                    Payment Status
                                </th>
                                <th>
                                    Order Status
                                </th>
                                <th>
                                    Total Amount
                                </th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{-- Format Human Redable --}}
                                    {{ $order->created_at->format('d M, Y') }}
                                </td>
                                <td>
                                    {{ $order->products->count() }}
                                </td>
                                <td>
                                    <h4 class="text-capitalize">
                                        <span class="badge {{ $order->payment_status == 'unpaid' ? 'bg-soft-danger text-danger' : ' bg-soft-success text-success' }}">{{ $order->payment_status }}</span>
                                    </h4>
                                </td>
                                <td>
                                    <h4 class="text-capitalize">
                                        <span class="badge {{ $order->status == 'pending' ? 'bg-soft-danger text-danger' : ' bg-soft-success text-success' }}">{{ $order->status }}</span>
                                    </h4>
                                </td>
                                <td>
                                    ${{ $order->order_total }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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
