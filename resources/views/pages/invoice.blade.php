@extends('layouts.vertical', ['page_title' => 'Invoice', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
                <h4 class="page-title">Invoice</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

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
                                <p><b>Hello, {{ Auth::user()->name }}</b></p>
                                <p class="text-muted fs-13">
                                    Please find below a cost-breakdown for the order #123456 placed with us on {{ now()->format('M d, Y') }}. If you have any questions concerning this quote, please contact our sales department.
                                </p>
                            </div>

                        </div><!-- end col -->
                        <div class="col-sm-4 offset-sm-2">
                            <div class="mt-3 float-sm-end">
                                <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{ now()->format('M d, Y') }}</p>
                                <p class="fs-13"><strong>Order Status: </strong> <span class="badge bg-success float-end">Paid</span></p>
                                <p class="fs-13"><strong>Order ID: </strong> <span class="float-end">#123456</span></p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-4">
                        <div class="col-4">
                            <h6>Billing Address</h6>
                            <address>
                                Lynne K. Higby<br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                        </div> <!-- end col-->

                        <div class="col-4">
                            <h6>Shipping Address</h6>
                            <address>
                                Tosha Minner<br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
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
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Unit Cost</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <b>
                                                    Roadster Women Round Neck
                                                </b> <br />
                                                Color: <span class="text-muted">Purple</span> - Size: <span class="text-muted">XL</span>
                                            </td>
                                            <td>1</td>
                                            <td>$1799.00</td>
                                            <td class="text-end">$17.00</td>
                                        </tr>
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
                                <p><b>Sub-total:</b> <span class="float-end">$17.00</span></p>
                                <p><b>VAT (12.5):</b> <span class="float-end">$1.00</span></p>
                                <h3>$18.00 USD</h3>
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

</div> <!-- container -->
@endsection
