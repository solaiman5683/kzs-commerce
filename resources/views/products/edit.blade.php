@extends('layouts.vertical', ['page_title' => 'Edit '.$product->name, 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                        <li class="breadcrumb-item"><a href="{{ route('second', ['products', 'index']) }}">Products</a></li>
                        <li class="breadcrumb-item active">
                            {{ $product->name  }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Edit :: {{ $product->name  }}
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
                        Please fill the form to add a new product. All fields are . You can add a new product from here.
                    </p>

                    <form action="{{ route('third', ['products', $product->id , 'edit']) }}" enctype="multipart/form-data" class="needs-validation" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="mb-2 col-lg-6">
                                <label class="form-label" for="name">
                                    Product Name
                                </label>
                                <input type="text" value="{{ old('name', $product->name) }}" class="form-control" id="name" placeholder="Enter Product Name" name="name">
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
                                <input type="text" class="form-control" value="{{ $product->slug }}" id="slug" placeholder="Slug" name="slug">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid slug.
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="description">
                                Product Description
                            </label>
                            <textarea class="form-control" id="description" placeholder="Enter Product Descriptiom" name="description">{{ $product->description }}</textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid product name.
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="purchase_price">
                                    Purchase Price
                                </label>
                                <input type="text" class="form-control" value="{{ $product->inventory->purchase_price }}" id="purchase_price" name="purchase_price">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid image for the product.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="price">
                                    Price
                                </label>
                                <input type="text" value="{{ $product->price }}" pattern="\d+(\.\d{1,2})?" oninput="validateDecimal(this)" class="form-control" id="price" placeholder="Enter Price" name="price">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Price for the product.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="sale_price">
                                    Sell Price
                                </label>
                                <input type="text" pattern="\d+(\.\d{1,2})?" value="{{ $product->sale_price }}" oninput="validateDecimal(this)" class="form-control" id="sale_price" placeholder="Enter Sale Price" name="sale_price">
                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="categories">
                                    Categories
                                </label>
                                <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" id="categories" name="categories[]">
                                    {{-- {{ dd($categories) }} --}}
                                    {{-- @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach --}}
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                    {{-- <optgroup label="Fashion">
                                        <option value="man">Man's Fashion</option>
                                        <option value="women">
                                            Women's Fashion
                                        </option>
                                    </optgroup> --}}
                                </select>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="image">
                                    Image
                                </label>
                                <input type="file" accept="image/*" class="form-control" id="image" name="image">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid image for the product.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="gallery">
                                    Gellary Images
                                </label>
                                <input type="file" accept="image/*" multiple class="form-control" id="gallery" name="gallery[]">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid image for the product.
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 mt-3">
                            <label class="form-label pe-4" for="featured">
                                <input type="checkbox" id="featured" name="featured" {{ $product->featured == 'true' ? 'checked' : '' }}>
                                Is this product featured?
                            </label>
                            <label class="form-label pe-4" for="isNewArrival">
                                <input type="checkbox" id="isNewArrival" name="isNewArrival" {{ $product->isNewArrival == 'true' ? 'checked' : '' }}>
                                Is this product new Arrival?
                            </label>
                            <label class="form-label" for="isOnSale">
                                <input type="checkbox" id="isOnSale" name="isOnSale" {{ $product->isOnSale == 'true' ? 'checked' : '' }}>
                                Is this product on sale?
                            </label>
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
<script>
    $(document).ready(function() {
        $('#name').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
        });
    });

    function validateDecimal(input) {
        input.value = input.value.replace(/[^0-9.]/g, ''); // Allow only digits and one decimal point
    }

</script>
@endsection
