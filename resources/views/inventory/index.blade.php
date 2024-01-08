@extends('layouts.vertical', ['page_title' => 'Inventory', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                            Inventory <span class="badge bg-soft-success text-success ms-2">
                                {{ now()->format('d M Y') }}
                            </span>
                        </h4>
                        {{-- <a href="{{ route('second', ['products', 'create']) }}" class="btn btn-sm btn-success waves-effect waves-light">
                        <i class="ri-add-fill me-1 align-middle"></i>
                        Add New Product
                        </a> --}}
                    </div>
                    <p class="text-muted fs-14">
                        This is the list of all products in the inventory. You can update inventory from here.
                    </p>

                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>S/L</th>
                                <th>Name</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                                <th>Stock Quantity</th>
                                <th>
                                    Quantity Alert
                                </th>
                                <th>
                                    Action
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
                                    {{ $item->product->name  }}
                                </td>
                                <td>
                                    <h4>${{ $item->purchase_price }}</h4>
                                </td>
                                <td>
                                    <h4>${{ $item->product->sale_price  }} <small><del>${{ $item->product->price  }}</del></small></h4>
                                </td>
                                <td>
                                    <h5>
                                        {{ $item->quantity }}
                                    </h5>
                                </td>
                                <td>
                                    <h4 style="font-size: .8rem;" class="badge {{ $item->quantity > 5 ? 'bg-soft-success text-success' : ' bg-soft-danger text-danger' }}">{{ $item->quantity > 5 ? 'Stock Available' : 'Low Stock' }}</h4>
                                </td>
                                <td>
                                    <a href="{{ route('third', ['inventory', $item->id, 'edit']) }}" class="btn btn-xs btn-secondary waves-effect waves-light"><i class="ri-edit-2-fill "></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div> <!-- container -->
@endsection

@section('script')
@vite(['resources/js/pages/demo.datatable-init.js'])
@endsection
