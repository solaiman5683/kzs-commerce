@extends('layouts.vertical', ['page_title' => 'Edit '.$inventory->product->name, 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@vite(['node_modules/select2/dist/css/select2.min.css'])
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
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

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', ['index']) }}">KZS</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('second', ['inventory', 'index']) }}">Inventory</a></li>
                        <li class="breadcrumb-item active">
                            {{ $inventory->product->name  }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Edit :: {{ $inventory->product->name  }} :: Inventory
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        Product Details
                    </h4>
                    <p class="text-muted fs-14">
                        Please fill the form to update the product inventory details.
                    </p>

                    <form action="{{ route('third', ['inventory', $inventory->id , 'edit']) }}" enctype="multipart/form-data" class="needs-validation" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="mb-2 col-lg-6">
                                <label class="form-label" for="quantity">
                                    Quantity in Stock
                                </label>
                                <input type="text" class="form-control" value="{{ old('name', $inventory->quantity) }}" id="quantity" placeholder="quantity" name="quantity">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid slug.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <label class="form-label" for="purchase_price">
                                    Purchase Price
                                </label>
                                <input type="text" class="form-control" value="{{ $inventory->purchase_price }}" id="purchase_price" name="purchase_price">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid image for the product.
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div> <!-- container -->


<!-- file preview template -->
<div class="d-none" id="uploadPreviewTemplate">
    <div class="card mt-1 mb-0 shadow-none border">
        <div class="p-2">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                </div>
                <div class="col ps-0">
                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                    <p class="mb-0" data-dz-size></p>
                </div>
                <div class="col-auto">
                    <!-- Button -->
                    <a href="" class="btn btn-link btn-lg text-danger" data-dz-remove>
                        <i class="ri-close-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@vite(['resources/js/pages/demo.form-advanced.js'])
{{-- Jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
