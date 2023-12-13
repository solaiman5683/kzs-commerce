@extends('layouts.vertical', ['page_title' => 'Datatables', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">
                            All Products <span class="badge bg-soft-success text-success ms-2">
                                {{ 0 }}
                            </span>
                        </h4>
                        <a href="{{ route('second', ['products', 'add-new']) }}" class="btn btn-sm btn-success waves-effect waves-light">
                            <i class="ri-add-fill me-1 align-middle"></i>
                            Add New Product
                        </a>
                    </div>
                    <p class="text-muted fs-14">
                        All products list in the system. You can add, edit or delete a product from here.
                    </p>

                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Featured</th>
                                <th>New Arrival</th>
                                <th>Categories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>01</td>
                                <td>
                                    Product Name
                                </td>
                                <td>
                                    Product Description
                                </td>
                                <td>
                                    $100
                                </td>
                                <td>
                                    $80
                                </td>
                                <td>
                                    <span class="badge bg-soft-success text-success">Yes</span>
                                </td>
                                <td>
                                    <span class="badge bg-soft-success text-success">Yes</span>
                                </td>
                                <td>
                                    <span class="badge bg-soft-success text-success">Category 1</span>
                                    <span class="badge bg-soft-success text-success">Category 2</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-secondary waves-effect waves-light"><i class="ri-edit-2-fill "></i></a>
                                    <a href="#" class="btn btn-xs btn-danger waves-effect waves-light">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </a>
                                </td>
                            </tr>
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
