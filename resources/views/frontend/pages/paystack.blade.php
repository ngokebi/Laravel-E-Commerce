@extends('layouts.app')

@section('content')
@section('title')
    PayStack Payment Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Stripe</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->




<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">





                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Shopping Amount </h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>SubTotal: </strong> N{{ $cartTotal }}
                                                <hr>

                                                <strong>Coupon Name : </strong>
                                                {{ session()->get('coupon')['coupon_name'] }}
                                                ( {{ session()->get('coupon')['discount'] }} % )
                                                <hr>

                                                <strong>Coupon Discount : </strong>
                                                N{{ session()->get('coupon')['discount_amount'] }}
                                                <hr>

                                                <strong>Grand Total : </strong>
                                                N{{ session()->get('coupon')['total_amount'] }}
                                                <hr>
                                            @else
                                                <strong>SubTotal: </strong> N{{ $cartTotal }}
                                                <hr>

                                                <strong>Grand Total : </strong> N{{ $cartTotal }}
                                                <hr>
                                            @endif

                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div> <!--  // end col md 6 -->







                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Payment Method</h4>
                                </div>

                                    @csrf
                                    <div class="form-row">
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                            <img src="{{ asset('frontend/assets/images/payments/paystack.png') }}"
                                                alt="" length='50px' width="150px">
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <br>
                                    @if (Session::has('coupon'))
                                        <button class="btn btn-primary"
                                            onclick="payWithPaystack('{{ session()->get('coupon')['total_amount'] }}')">Make
                                            Payment</button>
                                    @else
                                        <button class="btn btn-primary"
                                            onclick="payWithPaystack('{{ str_replace(',', '', $cartTotal) }}')">Make
                                            Payment</button>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div><!--  // end col md 6 -->
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
<script src="https://js.paystack.co/v1/inline.js"></script>

<script type="text/javascript">
    function payWithPaystack(plan_cost) {
        var handler = PaystackPop.setup({

            key: 'pk_test_ed3d043d18c250cdba9f3dbdf3cfd844bf6acd51',
            email: '<?php echo \Illuminate\Support\Facades\Auth::check() ? Auth()->user()->email : null; ?>',
            amount: plan_cost * 100,
            metadata: {
                order_id: (new Date().getTime()).toString(36)
            },
            onClose: function() {
                toastr.warning('Transaction cancelled');
            },
            callback: function(response) {

                window.location = "{{ URL::to('verify_product') }}/" + response.reference;
                // (status == "success") ? alert('Transcation Successful'): alert(response)
            }
        });
        handler.openIframe();
    }
</script>
