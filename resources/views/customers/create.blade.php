@extends('layouts.vertical', ['page_title' => 'Add New Product', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                        <li class="breadcrumb-item"><a href="{{ route('second', ['products', 'index']) }}">Customers</a></li>
                        <li class="breadcrumb-item active">New Customers</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Add New Customers
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
                        Customers Details
                    </h4>
                    <p class="text-muted fs-14">
                        Please fill the form to add a new customer. All the fields are required.
                    </p>

                    <form action="{{ route('second', ['customers', 'create']) }}" class="needs-validation" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="users">
                                    User
                                </label>
                                <select class="select2 form-control" data-toggle="select2" id="users" name="user_id" required>
                                    {{-- {{ dd($categories) }} --}}
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }}) </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="phone">
                                    Phone Number
                                </label>
                                <input type="text" pattern="\d+(\.\d{1,2})?" oninput="validateDecimal(this)" class="form-control" id="price" placeholder="Enter Phone Number" name="phone" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Phone Number for the customer.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="alternate_phone">
                                    Alternate Phone
                                </label>
                                <input type="text" pattern="\d+(\.\d{1,2})?" oninput="validateDecimal(this)" class="form-control" id="price" placeholder="Enter Phone Number" name="alternate_phone">
                            </div>
                        </div>
                        <p class="mt-2">
                            <strong>Shipping Address</strong>
                        </p>
                        <div class="row">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="shipping_address_line1">
                                    Address Line 1
                                </label>
                                <input type="text" class="form-control" id="shipping_address_line1" placeholder="Enter Address Line 1" name="shipping_address_line1" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Address Line 1 for the customer.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="shipping_address_line2">
                                    Address Line 2
                                </label>
                                <input type="text" class="form-control" id="shipping_address_line2" placeholder="Enter Address Line 2" name="shipping_address_line2">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="shipping_city">
                                    City
                                </label>
                                <input type="text" class="form-control" id="shipping_city" placeholder="Enter City" name="shipping_city" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid City for the customer.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="shipping_state">
                                    State
                                </label>
                                <input type="text" class="form-control" id="shipping_state" placeholder="Enter State" name="shipping_state" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid State for the customer.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="shipping_zipcode">
                                    Zip Code
                                </label>
                                <input type="text" class="form-control" id="shipping_zipcode" placeholder="Enter Zip Code" name="shipping_zipcode" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Zip Code for the customer.
                                </div>
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="shipping_country">
                                    Country
                                </label>
                                <input type="text" class="form-control" id="shipping_country" placeholder="Enter Country Name" name="shipping_country" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Country Name for the customer.
                                </div>
                            </div>
                        </div>
                        <p class="mt-2">
                            <strong>Billing Address</strong> <small>
                                (Keep it blank if same as shipping address)
                            </small>
                        </p>
                        <div class="row">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="billing_address_line1">
                                    Address Line 1
                                </label>
                                <input type="text" class="form-control" id="billing_address_line1" placeholder="Enter Address Line 1" name="billing_address_line1">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="billing_address_line2">
                                    Address Line 2
                                </label>
                                <input type="text" class="form-control" id="billing_address_line2" placeholder="Enter Address Line 2" name="billing_address_line2">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="billing_city">
                                    City
                                </label>
                                <input type="text" class="form-control" id="billing_city" placeholder="Enter City" name="billing_city">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="billing_state">
                                    State
                                </label>
                                <input type="text" class="form-control" id="billing_state" placeholder="Enter State" name="billing_state">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="billing_zipcode">
                                    Zip Code
                                </label>
                                <input type="text" class="form-control" id="billing_zipcode" placeholder="Enter Zip Code" name="billing_zipcode">
                            </div>
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="billing_country">
                                    Country
                                </label>
                                <input type="text" class="form-control" id="billing_country" placeholder="Enter Country Name" name="billing_country">
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
