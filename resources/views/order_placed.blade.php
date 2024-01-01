<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Invoice - KZS Style'])
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])

    @vite(['resources/js/head.js'])
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Invoice Logo-->
                            <div class="clearfix">
                                <div class="float-start mb-3">
                                    <img src="/images/logo-dark.png" alt="dark logo" height="32">
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div>

                            <!-- Invoice Detail-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="float-end mt-3">
                                        <p><b>{{ $order->customer->user->name }}</b></p>
                                        <p class="text-muted fs-13">
                                            Please find below a cost-breakdown for the order #123456 placed with us on Jan 01, 2024. If you have any questions concerning this quote, please contact our sales department.
                                        </p>
                                    </div>

                                </div><!-- end col -->
                                <div class="col-sm-4 offset-sm-2">
                                    <div class="mt-3 float-sm-end">
                                        <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{ $order->created_at }}</p>
                                        <p class="fs-13"><strong>Order Status: </strong> <span class="badge bg-success float-end">{{ $order->payment_status }}</span></p>
                                        <p class="fs-13"><strong>Order ID: </strong> <span class="float-end">#00{{ $order->id }}</span></p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row mt-4">
                                <div class="col-4">
                                    <h6>Billing Address</h6>
                                    <address>
                                        {{ $order->customer->billing_address_line1 }}<br>
                                        {{ $order->customer->billing_address_line2 }}<br>
                                        {{ $order->customer->billing_city }},{{ $order->customer->billing_state }}<br>
                                        <abbr title="Phone">P:</abbr> {{ $order->customer->phone }}
                                    </address>
                                </div> <!-- end col-->

                                <div class="col-4">
                                    <h6>Shipping Address</h6>
                                    <address>
                                        {{ $order->customer->shipping_address_line1 }}<br>
                                        {{ $order->customer->shipping_address_line2 }}<br>
                                        {{ $order->customer->shipping_city }},{{ $order->customer->shipping_state }}<br>
                                        <abbr title="Phone">P:</abbr> {{ $order->customer->alternate_phone }}
                                    </address>
                                </div> <!-- end col-->

                                <div class="col-4">
                                    <div class="text-sm-end">
                                        <img src="/images/barcode.png" alt="barcode-image" class="img-fluid me-2" />
                                    </div>
                                </div> <!-- end col-->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $counter = 1;
                                                @endphp
                                                @foreach ($order->products as $product)
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <td>
                                                        <b>
                                                            {{ $product->name }}
                                                        </b> <br />
                                                        {{-- Color: <span class="text-muted">Purple</span> - Size: <span class="text-muted">XL</span> --}}
                                                    </td>
                                                    <td>{{ $product->pivot->quantity }}</td>
                                                    <td>
                                                        €{{ $product->sale_price }}
                                                    </td>
                                                    <td class="text-end">
                                                        €{{ $product->pivot->quantity * $product->sale_price }}
                                                    </td>
                                                </tr>

                                                @endforeach



                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-3">
                                        <h6 class="text-muted">Notes:</h6>
                                        <small>
                                            Our return policy allows you to return the product within 7 days of the delivery date. Please review our return policy on our website for more details.
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end mt-3 mt-sm-0">
                                        <p>
                                            <b class="pe-3">Sub-total: </b> <span class="float-end">
                                            €{{ $order->order_total }}
                                        </span></p>
                                        <p><b>VAT:</b> <span class="float-end">€0.00</span></p>
                                        <h3 class="text-end">€{{ $order->order_total }}</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->

                            <div class="d-print-none mt-4">
                                <div class="text-end">
                                    <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i> Print</a>
                                </div>
                            </div>
                            <!-- end buttons -->

                        </div> <!-- end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    {{-- @include('layouts.shared/right-sidebar')
    @include('layouts.shared/footer-script') --}}
    @vite(['resources/js/app.js', 'resources/js/layout.js'])
    {{-- @yield('script') --}}

</body>

</html>


