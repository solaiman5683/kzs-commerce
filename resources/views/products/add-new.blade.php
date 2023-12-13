@extends('layouts.vertical', ['page_title' => 'Add New Product', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@vite(['node_modules/select2/dist/css/select2.min.css'])
@endsection

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">New Product</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Add New Product
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
                        Please fill the form to add a new product. All fields are required. You can add a new product from here.
                    </p>

                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="mb-2 col-lg-6">
                                <label class="form-label" for="title">
                                    Product Name
                                </label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Product Name" name="title" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid product name.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <label class="form-label" for="slug">
                                    Slug
                                </label>
                                <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid slug.
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="descriptiom">
                                Product Description
                            </label>
                            <textarea class="form-control" id="descriptiom" placeholder="Enter Product Descriptiom" name="title" required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid product name.
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="price">
                                    Price
                                </label>
                                <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Price for the product.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="sell_price">
                                    Sell Price
                                </label>
                                <input type="number" class="form-control" id="sell_price" placeholder="Enter Sell Price" name="sell_price">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="categories">
                                    Categories
                                </label>
                                <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" id="categories" name="categories" required>
                                    <optgroup label="Fashion">
                                        <option value="man">Man's Fashion</option>
                                        <option value="women">
                                            Women's Fashion
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

</div> <!-- container -->
@endsection

@section('script')
@vite(['resources/js/pages/demo.form-advanced.js'])
{{-- Jquery cdn --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
        });
    });

</script>
@endsection
