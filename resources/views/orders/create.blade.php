@extends('layouts.vertical', ['page_title' => 'Order Now', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                        <li class="breadcrumb-item"><a href="{{ route('second', ['orders', 'index']) }}">Orders</a></li>
                        <li class="breadcrumb-item active">New Orders</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Place New Order
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
                        Product Order Details
                    </h4>
                    <p class="text-muted fs-14">
                        Please fill the form to add a new product. All fields are required. You can add a new product from here.
                    </p>

                    <h2 class="text-center">
                        <span class="badge badge-pill badge-soft-success font-size-24">Total:

                            $<span id="total">0.00</span>
                        </span>
                    </h2>

                    <form action="{{ route('second', ['orders', 'create']) }}" enctype="multipart/form-data" class="needs-validation" method="POST" novalidate>
                        @csrf
                        <div class="row align-items-end">
                            <div class="mb-2 col-lg-4">
                                <label class="form-label" for="customer">Customer</label>
                                <select class="select2 form-control" data-toggle="select2" id="customer" name="customer_id" required>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-lg-3">
                                <label class="form-label" for="products">Products</label>
                                <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" id="products" name="products[]" required>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-lg-3">
                                <label class="form-label" for="payment">Payment</label>
                                <select class="select2 form-control select2-single" data-toggle="select2" id="payment" name="payment_status" required>
                                    <option value="unpaid">
                                        Unpaid
                                    </option>
                                    <option value="paid">
                                        Paid
                                    </option>
                                </select>
                            </div>
                            <div class="mb-2 col-lg-2">
                                <input type="hidden" value="0" name="total" id="total-input">
                                <button type="button" class="form-control btn btn-success" onclick="addProductInput()">Add Quantity</button>
                            </div>
                        </div>
                        <div class="row" id="product-quantities-container">
                            <!-- Product quantity inputs will be dynamically added here -->
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

<script>
    function addProductInput() {
        const container = document.getElementById('product-quantities-container');
        const productsSelect = document.getElementById('products');
        const selectedProducts = Array.from(productsSelect.selectedOptions);

        let total = 0; // Initialize total

        selectedProducts.forEach(productOption => {
            const productId = productOption.value;

            // Check if a quantity input already exists for the product
            if (!container.querySelector(`#quantity-${productId}`)) {
                const inputGroup = document.createElement('div');
                inputGroup.classList.add('mb-2', 'col-lg-6');

                const label = document.createElement('label');
                label.classList.add('form-label');
                label.textContent = `Quantity for ${productOption.textContent}`;

                const input = document.createElement('input');
                input.type = 'number';
                input.classList.add('form-control');
                input.placeholder = 'Select Quantity';
                input.name = `quantities[${productId}]`;
                input.id = `quantity-${productId}`;
                input.required = true;

                // Add an event listener to update the total when the quantity changes
                input.addEventListener('input', updateTotal);

                const validFeedback = document.createElement('div');
                validFeedback.classList.add('valid-feedback');
                validFeedback.textContent = 'Looks good!';

                const invalidFeedback = document.createElement('div');
                invalidFeedback.classList.add('invalid-feedback');
                invalidFeedback.textContent = 'Please provide a valid quantity.';

                inputGroup.appendChild(label);
                inputGroup.appendChild(input);
                inputGroup.appendChild(validFeedback);
                inputGroup.appendChild(invalidFeedback);

                container.appendChild(inputGroup);
            }
        });

        // Update the total when adding a new product input
        updateTotal();

        function updateTotal() {
            total = 0; // Reset total

            // Recalculate total based on quantities and prices
            selectedProducts.forEach(productOption => {
                const productId = productOption.value;
                const quantityInput = document.getElementById(`quantity-${productId}`);
                const quantity = parseInt(quantityInput.value) || 0;

                // Replace this with the actual price of the product
                const products = @json($products);
                const product = products.find(product => product.id == productId);
                const price = product.sale_price ? product.sale_price : product.price;


                total += quantity * price;
            });

            // Update the total in the #total element
            document.getElementById('total').textContent = total.toFixed(2);
            document.getElementById('total-input').value = total.toFixed(2);
        }
    }
</script>
@endsection
