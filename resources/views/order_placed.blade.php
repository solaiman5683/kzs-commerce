<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add your inline styles here */
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .logo {
            margin-right: auto;
            margin-bottom: 10px;
            width: 150px;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .float-start {
            float: left;
        }

        .float-end {
            float: right;
        }

        img {
            max-width: 100%;
            height: auto;
            vertical-align: middle;
        }

        h4, h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border: 2px solid #dee2e6;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .fs-13 {
            font-size: 13px;
        }

        .badge {
            border-radius: 0.25rem;
            font-size: 90%;
            padding: 0.25em 0.4em;
        }
        .text-end {
            text-align: right;
        }

        .flex {
            display: flex;
            width: 100%;
        }
        .justify-between {
            justify-content: space-between;
        }

        .mb-4{
            margin-bottom: 1.5rem;
        }
        .mt-4{
            margin-top: 1.5rem;
        }
        .w-50{
            width: 50%;
        }

        .logo-box{
            background: #ffffff;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Invoice Logo-->
                    <div class="flex justify-between mb-4">
                        <img class="logo" src="https://kzsecommerce.icicle.dev/images/logo-dark.png" alt="KZS Style" >
                        <h4 class="text-end">Invoice</h4>
                    </div>

                    <!-- Invoice Detail-->
                    <div>
                        <div>
                            <div>
                                <p><b>{{ $order->customer->user->name }}</b></p>
                                <p class="text-muted fs-13">
                                    Please find below a cost-breakdown for the order #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }} placed with us on Jan 01, 2024. If you have any questions concerning this quote, please contact our sales department.
                                </p>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{ $order->created_at }}</p>
                                <p><strong>Order Status: </strong> <span>{{ $order->payment_status }}</span></p>
                                <p><strong>Order ID: </strong> <span>#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}   </span></p>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="flex between mt-4 mb-4">
                        <div class="w-50">
                            <h4>Billing Address</h3>
                            <address>
                                {{ $order->customer->billing_address_line1 }}<br>
                                {{ $order->customer->billing_address_line2 }}<br>
                                {{ $order->customer->billing_city }},{{ $order->customer->billing_state }}<br>
                                <span title="Phone">Phone: </span> {{ $order->customer->phone }}
                            </address>
                        </div>
                        <div class="w-50">
                            <h4>Shipping Address</h4>
                            <address>
                                {{ $order->customer->shipping_address_line1 }}<br>
                                {{ $order->customer->shipping_address_line2 }}<br>
                                {{ $order->customer->shipping_city }},{{ $order->customer->shipping_state }}<br>
                                <span title="Phone">Phone: </span> {{ $order->customer->alternate_phone }}
                            </address>
                        </div>
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
                                            </td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td class="text-end">
                                                €{{ $product->sale_price }}
                                            </td>
                                            <td class="text-end">
                                                €{{ $product->pivot->quantity * $product->sale_price }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" rowspan="3"></td>
                                            <td class="text-end total-section"><b>Sub-total:</b></td>
                                            <td class="text-end"><b>€{{ $order->order_total }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-end total-section"><b>VAT:</b></td>
                                            <td class="text-end"><b>€0.00</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-end total-section"><b>Total:</b></td>
                                            <td class="text-end total-section"><b>€{{ $order->order_total }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-3">
                                <h4>Notes:</h6>
                                <p>
                                    Our return policy allows you to return the product within 7 days of the delivery date. Please review our return policy on our website for more details.
                                </p>
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="float-end mt-3 mt-sm-0 total-section">
                                <p class="total-label"><b>Sub-total:</b></p>
                                <p>€{{ $order->order_total }}</p>
                                <p class="total-label"><b>VAT:</b></p>
                                <p>€0.00</p>
                                <h3 class="text-end total-label">Total: €{{ $order->order_total }}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div> --}}
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body-->
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
</body>
</html>
