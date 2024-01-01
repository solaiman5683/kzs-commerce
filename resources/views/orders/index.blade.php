@extends('layouts.vertical', ['page_title' => 'Orders', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@vite([
'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
'node_modules/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css',
'node_modules/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css',
'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css',
])
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid py-3">
    <div class="mt-3">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">
                            All Orders <span class="badge bg-soft-success text-success ms-2">
                                {{ $orders->count() }}
                            </span>
                        </h4>
                        <a href="{{ route('second', ['orders', 'create']) }}" class="btn btn-sm btn-success waves-effect waves-light">
                            <i class="ri-add-fill me-1 align-middle"></i>
                            Place New Order
                        </a>
                    </div>
                    <p class="text-muted fs-14">
                        All products list in the system. You can add, edit or delete a product from here.
                    </p>
                    <div class="table-responsive pb-4">
                        <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Customer Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                    <th>
                                        Transaction Id
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->id }}
                                        </td>
                                        <td>
                                            @foreach ($order->products as $product)
                                                {{ $product->name }} ({{ $product->pivot->quantity }}) <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $order->customer->user->name }}
                                        </td>
                                        <td>
                                            {{ $order->products->sum('pivot.quantity') }}
                                        </td>
                                        <td>
                                            ${{ $order->order_total }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $order->status == 'pending' ? 'bg-soft-warning text-warning' : ' bg-soft-success text-success' }}">{{ $order->status }}</span>
                                        </td>

                                        <td>
                                            <span class="badge {{ $order->payment_status == 'unpaid' ? 'bg-soft-warning text-warning' : ' bg-soft-success text-success' }}">{{ $order->payment_status }}</span>
                                        </td>
                                        <td>
                                            {{ $order->payment_method ?? 'N/A'  }}
                                        </td>
                                        <td>
                                            {{ $order->transaction_id ? $order->transaction_id : 'N/A' }}
                                        </td>
                                        <td>
                                            {{-- button for make paid --}}
                                            @if ($order->payment_status == 'unpaid')
                                                <a href="{{ route('third', ['orders', $order->id, 'make-paid']) }}" class="btn btn-xs btn-success waves-effect waves-light">
                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div> <!-- container -->
@endsection

@section('script')
@vite(['resources/js/pages/demo.datatable-init.js'])
@endsection
