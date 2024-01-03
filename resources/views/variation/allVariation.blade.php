@extends('layouts.vertical', ['page_title' => 'Categories', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                            All Attribute <span class="badge bg-soft-success text-success ms-2">
                                {{ $variation->count() }}
                            </span>
                        </h4>
                        <a href="{{ route('addAttribute')}}" class="btn btn-sm btn-success waves-effect waves-light">
                            <i class="ri-add-fill me-1 align-middle"></i>
                            Add New Attribute
                        </a>
                    </div>
                    <p class="text-muted fs-14">
                        All products list in the system. You can add, edit or delete a product from here.
                    </p>

                   <div class="table-responsive">
                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Attribute Name</th>
                                <th>Value</th>
                                <th>Meta</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($variation as $variations)
                            <tr>
                                <td>
                                    {{ $variations->id }}
                                </td>
                                <td>
                                    {{ $variations->attribute->name }}
                                </td>
                                <td>
                                    {{ $variations->value }}
                                </td>
                                <td>
                                    {{ $variations->meta }}
                                </td>

                                <td>
                                    <a href="" class="btn btn-xs btn-secondary waves-effect waves-light"><i class="ri-edit-2-fill "></i></a>
                                    <a href="" class="btn btn-xs btn-danger waves-effect waves-light">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </a>
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
